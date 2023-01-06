<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use App\Models\User;
use App\Models\Sampletype;
use App\Models\Attributesample;
use Livewire\Component;

class CreateBiosample extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $title;
    public $description;
    public $hold_release;
    public $biosample_links = [];
    public $comments;

    public $sampletypes = [];
    public $sampletype_id;
    public $sample_find;
    public $sampletype_attributes = [];
    public $attributes = [];
    public $attribute_id;

    //variables for attributes
    public $sample_name;
    public $organism;
    public $isolate;
    public $strain;
    public $isolation_source;
    public $collected_by;
    public $collection_date;
    public $geographic_location;
    public $lat_lon;
    public $culture_collection;
    public $genotype;
    public $passage_history;
    public $serovar;
    public $specimen_voucher;
    public $subgroup;
    public $subtype;
    public $host;
    public $host_disease;
    public $host_age;
    public $host_description;
    public $host_disease_outcome;
    public $host_disease_stage;
    public $host_health_outcome;
    public $host_sex;
    public $host_subject_id;
    public $host_tissue_sampled;
    public $pathotype;
    public $serotype;
    public $altitude;
    public $biomaterial_provider;
    public $lab_host;
    public $depth;
    public $environmental_biome;
    public $identified_by;
    public $sample_size;
    public $temperature;
    public $disease;
    public $mating_type;
    public $age;
    public $sex;
    public $tissue;
    public $cell_line;
    public $cell_type;
    public $cell_subtype;
    public $disease_stage;
    public $development_stage;
    public $phenotype;
    public $birth_location;
    public $birth_date;
    public $death_date;
    public $growth_protocol;
    public $health_state;
    public $storage_condition;
    public $study_book_number;
    public $treatment;
    public $breed;
    public $breed_history;
    public $breed_method;
    public $ethnicity;
    public $race;
    public $karyotype;
    public $population;
    public $type;
    public $height_length;
    public $cultivar;


    protected $rules = [
        'title' => 'required|min:6',
        'description' => 'required|min:6',
        'hold_release' => 'required',
        'sampletype_id' => 'required',
        'comments' => '',
    ];

    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:6',
            'description' => 'required|min:6',
            'hold_release' => 'required',

            //'biosample_links.*.link_description' => 'required',
            //'biosample_links.*.link_url' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        $validatedData = $this->validate([
            'sampletype_id' => 'required',
        ]);
        
        $this->sample_find = Sampletype::find((int)$validatedData['sampletype_id']);
        $this->sampletype_attributes = explode(',', $this->sample_find->attribute_property);
        $this->attributes = [];
        $this->attributes = Attributesample::whereIn('id', $this->sampletype_attributes)->get();
        
        $this->currentStep = 4;
    }

    public function fourthStepSubmit()
    {
        $this->currentStep = 5;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function mount()
    {
        $this->submitter_name = auth()->user()->name;
        $this->submitter_email = auth()->user()->email;
        $this->submitter_lab = auth()->user()->lab->name;
        $this->submitter_center = auth()->user()->lab->center->name;

        //$this->biosample_links = [
        //    ['biosamplelink_id' => '', 'biosample_link_description' => 'desc', 'biosample_link_url' => 'url']
        //];

        $this->sampletypes = Sampletype::all();

    }

    public function addLink()
    {
        $this->biosample_links[] = ['biosample_link_description' => '', 'biosample_link_url' => ''];
    }

    public function removeLink($index)
    {
        unset($this->biosample_links[$index]);
        $this->biosample_links = array_values($this->biosample_links);
    }

    public function submitForm()
    {

        $validatedData = $this->validate();
        $biosample = new Biosample();
        $biosample->accession = 'SAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->submission_id = 'SUBSAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->title = $validatedData['title'];
        $biosample->description = $validatedData['description'];
        $biosample->hold_release = $validatedData['hold_release'];
        $biosample->comments = $validatedData['comments'];
        $biosample->sampletype_id = $validatedData['sampletype_id'];

        $biosample->center_id = auth()->user()->lab->center_id;
        $biosample->user_id = auth()->user()->id;

        $biosample->save();

        if (count($validatedData['biosample_link']) > 0) {
            foreach ($validatedData['biosample_link'] as  $item => $value) {
                $data1 = array(
                    'biosample_id' => $biosample->id,
                    'link_description' => $validatedData['biosample_link'][$item]['biosample_link_description'],
                    'link_url' => $validatedData['biosample_link'][$item]['biosample_link_url'],
                );
                BioSampleExternalLink::create($data1);
            }
        }

        session()->flash('message', 'Biosample successfully created.');
        return redirect()->to('/dashboard/biosamples/' . $biosample->accession);
    }

    public function render()
    {
        // info($this->grants);
        return view('livewire.biosample.create');
    }


}
