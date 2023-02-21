<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attributesample;

class AttributeSampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Attributesample
        Attributesample::create([
            'attr_name'=>'sample_name',
            'attr_text'=>'Sample Name',
            'description'=>'The sample name is a name that you choose for the sample.  Each sample name must be unique in a submission.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sample_title',
            'attr_text'=>'Sample Title',
            'description'=>'Sample title should be short and informative. Each sample title must be <span class="attention_text">unique</span> in a submission.  Examples: 1) Escherichia coli O104:H4 str. C227-11 clinical isolate 2010_333_NC-6;  2) CD8+ T cells from female TSG6-knockout BALB/c mouse;  3) Human metagenome isolated from urine of healthy female.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'description',
            'attr_text'=>'Description',
            'description'=>'A brief description for the sample.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'organism',
            'attr_text'=>'Organism',
            'description'=>'The most descriptive organism name for this sample (to the species, if relevant) in the <a href="http://www.ncbi.nlm.nih.gov/taxonomy">NCBI Taxonomy database</a>. If it is not in the database, provide as much information about the organism as possible and the DDBJ staff apply a new organism name to NCBI Taxonomy.',
            'input_type_id'=>7,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'taxonomy_id',
            'attr_text'=>'Taxonomy ID',
            'description'=>'NCBI Taxonomy identifier. This is appropriate for individual organisms, <a href="http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Undef&id=12908&lvl=3&lin=f&keep=1&srchmode=1&unlock">some metagenomes and environmental samples</a>.  If it is not in the database, leave empty. The DDBJ staff apply a new organism name to NCBI Taxonomy, and then an assigned TaxID will be auto-filled.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bioproject_id',
            'attr_text'=>'Bioproject Id',
            'description'=>'Associated BioProject accession number (PRJDB)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'locus_tag_prefix',
            'attr_text'=>'Locus Tag Prefix',
            'description'=>'A locus tag prefix for an annotated genome <a href="https://www.ddbj.nig.ac.jp/ddbj/locus_tag-e.html">/locus tag qualifier</a>',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'strain',
            'attr_text'=>'Strain',
            'description'=>'Microbial/eukaryotic strain name',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'isolate',
            'attr_text'=>'Isolate',
            'description'=>'Identification or description of the specific individual from which this sample was obtained',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'breed',
            'attr_text'=>'Breed',
            'description'=>'Breed name - chiefly used in domesticated animals or plants',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cultivar',
            'attr_text'=>'Cultivar',
            'description'=>'Cultivar name - cultivated variety of plant',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ecotype',
            'attr_text'=>'Ecotype',
            'description'=>'A population within a given species displaying genetically based, phenotypic traits that reflect adaptation to a local habitat, e.g., Columbia',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'isolation_source',
            'attr_text'=>'Isolation Source',
            'description'=>'Describes the physical, environmental and/or local geographical source of the biological sample from which the sample was derived.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host',
            'attr_text'=>'Host',
            'description'=>'The natural (as opposed to laboratory) host to the organism from which the sample was obtained. Use the full taxonomic name, eg, "Homo sapiens".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'lab_host',
            'attr_text'=>'Lab Host',
            'description'=>'Originally meaning host on which a parasite is maintained in the lab, which may not be the same as the natural host (example hamster cells used to support a parasite normally found in mouse in the wild).',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'age',
            'attr_text'=>'Age',
            'description'=>'age at the time of sampling; relevant scale depends on species and study, e.g. could be seconds for amoebae or centuries for trees',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'dev_stage',
            'attr_text'=>'Development Stage',
            'description'=>'Developmental stage at the time of sampling.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tissue',
            'attr_text'=>'Tissue',
            'description'=>'Type of tissue the sample was taken from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sex',
            'attr_text'=>'Sex',
            'description'=>'physical sex of sampled organism',
            'input_type_id'=>3,
            'list_value'=>', male, female, pooled male and female, neuter, hermaphrodite, intersex, not determined, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'biomaterial_provider',
            'attr_text'=>'Biomaterial Provider',
            'description'=>'Name and address of the lab or PI, or a culture collection identifier',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sample_type',
            'attr_text'=>'Sample Type',
            'description'=>'Sample type, such as cell culture, mixed culture, tissue sample, whole organism, single cell, metagenomic assembly, primary cell',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'collection_date',
            'attr_text'=>'Collection Date',
            'description'=>'Time of sampling (single instance or interval, eg., 2008-01-23T19:23:10, 2008-01-23, 2008-01, 2008, 1952-10-21T11:43Z/1952-10-21T17:43Z, 1952-10-21/1953-02-15, 1952-10/1953-02, 1952/1953)  Follow ISO 8601 standard "YYYY-mm-dd", "YYYY-mm" or "YYYY-mm-ddThh:mm:ssZ" (e.g., 1990-10-30, 1990-10 or 1990-10-30T14:41:36Z). Collection times must be in Coordinated Universal Time (UTC). Times without time zone are processed as UTC. Non-UTC times are converted to UTC.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'geo_loc_name',
            'attr_text'=>'Geographic Location Name',
            'description'=>'Geographical origin of the sample indicated by countries or oceans, followed by regions and localities. Use an appropriate country or ocean name from the <a href="https://www.ddbj.nig.ac.jp/ddbj/country-e.html">country list</a> and add region and locality after a colon to separate the country or ocean e.g. "Japan:Kanagawa, Hakone, Lake Ashi". Entering multiple localities in one attribute is not allowed.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'lat_lon',
            'attr_text'=>'Latitude Longitude',
            'description'=>'The geographical coordinates of the location where the sample was collected. Specify as decimal degrees latitude and longitude in format "d[d.dddddddd] N|S d[dd.dddddddd] W|E", eg, “47.94 N 28.12 W” “45.0123 S 4.1234 E” When the information is lacking or specification of location is not appropriate, please enter "missing".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'env_broad_scale',
            'attr_text'=>'Environmental Biome',
            'description'=>'Add terms that identify the major environment type(s) where your sample was collected. Recommend subclasses of <a href="https://www.ebi.ac.uk/ols/ontologies/envo/terms?iri=http%3A%2F%2Fpurl.obolibrary.org%2Fobo%2FENVO_00000428">biome [ENVO:00000428]</a>. Multiple terms can be separated by one or more pipes e.g. mangrove biome [ENVO:01000181]|estuarine biome [ENVO:01000020]',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'env_local_scale',
            'attr_text'=>'Environmental Feature',
            'description'=>'Add terms that identify environmental entities having causal influences upon the entity at time of sampling, multiple terms can be separated by pipes, e.g.:  shoreline [ENVO:00000486]|intertidal zone [ENVO:00000316]	',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'env_medium',
            'attr_text'=>'Environment (material)',
            'description'=>'Add terms that identify the material displaced by the entity at time of sampling. Recommend subclasses of environmental material [ENVO:00010483]. Multiple terms can be separated by pipes e.g.: estuarine water [ENVO:01000301]|estuarine mud [ENVO:00002160]',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'depth',
            'attr_text'=>'Depth',
            'description'=>'Depth is defined as the vertical distance below surface, e.g. for sediment or soil samples depth is measured from sediment or soil surface, respectively. Depth can be reported as an interval for subsurface samples.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'elev',
            'attr_text'=>'Elevation',
            'description'=>'The elevation of the sampling site as measured by the vertical distance from mean sea level.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'altitude',
            'attr_text'=>'Altitude',
            'description'=>'The altitude of the sample is the vertical distance between Earth\'s surface above Sea Level and the sampled position in the air.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'isol_growth_condt',
            'attr_text'=>'Isolation and Growth Condition',
            'description'=>'Publication reference in the form of pubmed ID, DOI or URL for isolation and growth condition specifications of the organism/material',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'propagation',
            'attr_text'=>'Propagation',
            'description'=>'This field is specific to different taxa. For phage: lytic/lysogenic/temperate/obligately lytic;  for plasmid: incompatibility group;  for eukaryote: asexual/sexual',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ref_biomaterial',
            'attr_text'=>'Reference for Biomaterial',
            'description'=>'Primary publication if isolated before genome publication; otherwise, primary genome report in the form of pubmed ID, DOI or URL',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'num_replicons',
            'attr_text'=>'Number of Replicons',
            'description'=>'Reports the number of replicons in a nuclear genome of eukaryotes, in the genome of a bacterium or archaea or the number of segments in a segmented virus. Always applied to the haploid chromosome count of a eukaryote',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'collected_by',
            'attr_text'=>'Collected By',
            'description'=>'Name of persons or institute who collected the sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease',
            'attr_text'=>'Host Disease',
            'description'=>'Name of relevant disease, e.g. Salmonella gastroenteritis. For the controlled vocabulary, please see <a href="http://bioportal.bioontology.org/ontologies/1009">Human Disease Ontology</a> or <a href="http://www.ncbi.nlm.nih.gov/mesh">MeSH</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'metagenome_source',
            'attr_text'=>'Metagenome Source',
            'description'=>'Source of metagenomic sample described by <a href="https://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Tree&id=408169&lvl=3&lin=f&keep=1&srchmode=1&unlock">metagenomic organism names</a> in the taxonomy database. eg, "soil metagenome"',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'derived_from',
            'attr_text'=>'Derived From',
            'description'=>'Indicates where one BioSample was derived from another BioSample(s) by its BioSample accessions. e.g., SAMD00000001,SAMD00000002,SAMD00000005-SAMD00000010',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'abs_air_humidity',
            'attr_text'=>'Abs Air Humidity',
            'description'=>'Actual mass of water vapor - mh20 - present in the air water vapor mixture',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'air_temp',
            'attr_text'=>'Air Temperature',
            'description'=>'Temperature of the air at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'build_occup_type',
            'attr_text'=>'Building Occupation Type',
            'description'=>'Primary function for which a building or discrete part of a building is intended to be used',
            'input_type_id'=>3,
            'list_value'=>', office, market, restaurant, residence, school, residential, commercial, low rise, high rise, wood framed, health care, airport, sports complex, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'building_setting',
            'attr_text'=>'Building Setting',
            'description'=>'Location (geography) where a building is set',
            'input_type_id'=>3,
            'list_value'=>', urban, suburban, exurban, rural, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'carb_dioxide',
            'attr_text'=>'Carbon Dioxide',
            'description'=>'Carbon dioxide (gas) amount or concentration at the time of saampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'filter_type',
            'attr_text'=>'Filter Type',
            'description'=>'Device which removes solid particulates or airborne molecular contaminants',
            'input_type_id'=>3,
            'list_value'=>', particulate air filter, chemical air filter, low-MERV pleated media, HEPA, electrostatic, gas-phase or ultraviolet air treatments, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'heat_cool_type',
            'attr_text'=>'Heat Cool Type',
            'description'=>'Methods of conditioning or heating a room or building',
            'input_type_id'=>3,
            'list_value'=>', radiant system, heat pump, forced air system, steam forced heat, wood stove, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'indoor_space',
            'attr_text'=>'Indoor Space',
            'description'=>'A distinguishable space within a structure, the purpose for which discrete areas of a building is used',
            'input_type_id'=>3,
            'list_value'=>', bedroom, office, bathroom, foyer, kitchen, locker room, hallway, elevator, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'light_type',
            'attr_text'=>'Light Type',
            'description'=>'Application of light to achieve some practical or aesthetic effect. Lighting includes the use of both artificial light sources such as lamps and light fixtures, as well as natural illumination by capturing daylight. Can also include absence of light',
            'input_type_id'=>3,
            'list_value'=>', natural light, electric light, no light, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'occup_samp',
            'attr_text'=>'Occupants Number',
            'description'=>'Number of occupants present at time of sample within the given space',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'occupant_dens_samp',
            'attr_text'=>'Occupants Density',
            'description'=>'Average number of occupants at time of sampling per square footage',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'organism_count',
            'attr_text'=>'Organism Count',
            'description'=>'Total count of any organism per gram or volume of sample, should include name of organism followed by count; can include multiple organism counts',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'rel_air_humidity',
            'attr_text'=>'Rel Air Humidity',
            'description'=>'Partial vapor and air pressure, density of the vapor and air, or by the actual mass of the vapor and air',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'space_typ_state',
            'attr_text'=>'Space Type State',
            'description'=>'Customary or normal state of the space',
            'input_type_id'=>3,
            'list_value'=>', typical occupied, typically unoccupied, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'typ_occupant_dens',
            'attr_text'=>'Type of Occupant Density',
            'description'=>'Customary or normal density of occupants',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ventilation_type',
            'attr_text'=>'Ventilation Type',
            'description'=>'Ventilation system used in the sampled premises',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'source_uvig',
            'attr_text'=>'Source UViG',
            'description'=>'Type of dataset from which the UViG was obtained',
            'input_type_id'=>3,
            'list_value'=>', metagenome (not viral targeted), viral fraction metagenome (virome), sequence-targeted metagenome, metatranscriptome (not viral targeted), viral fraction RNA metagenome (RNA virome), sequence-targeted RNA metagenome, microbial single amplified genome (SAG), viral single amplified genome (vSAG), isolate microbial genome',
        ]);
        Attributesample::create([
            'attr_name'=>'virus_enrich_appr',
            'attr_text'=>'Virus Enrich Approach',
            'description'=>'Approach used to enrich the sample for viruses, if any. If more than one approach was used, include multiple ‘virus_enrich_appr’ fields.',
            'input_type_id'=>3,
            'list_value'=>', filtration, ultrafiltration, centrifugation, ultracentrifugation, PEG Precipitation, FeCl Precipitation, CsCl density gradient, DNAse, RNAse, targeted sequence capture',
        ]);
        Attributesample::create([
            'attr_name'=>'beta_lactamase_family',
            'attr_text'=>'Beta Lactamase Family',
            'description'=>'Specify the beta-lactamase family for this gene.',
            'input_type_id'=>3,
            'list_value'=>', ACC, ACT, ADC, BEL, CARB, CBP, CFE, CMY, CTX-M, DHA, FOX, GES, GIM, KPC, IMI, IMP, IND, LAT, MIR, MOX, NDM, OXA, PER, PDC, SHV, SME, TEM, VEB, VIM, unknown',
        ]);
        Attributesample::create([
            'attr_name'=>'carbapenemase',
            'attr_text'=>'Carbapenemase',
            'description'=>'Does the enzyme exhibit carbapenemase activity? If the enzyme does exhibit carbapenemase activity, the response should be "yes", otherwise "no."',
            'input_type_id'=>3,
            'list_value'=>', yes, no, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'edta_inhibitor_tested',
            'attr_text'=>'EDTA Inhibitor Tested',
            'description'=>'Was carbapenemase activity tested in the presence of EDTA? If carbapenemase activity was tested in the presence of EDTA, the response should be "yes", otherwise "no”.',
            'input_type_id'=>3,
            'list_value'=>', yes, no, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_population',
            'attr_text'=>'Wastewater Population',
            'description'=>'Number of persons contributing wastewater to this sample collection site; if unknown, estimate to the nearest order of magnitude, e.g., 10000. If no estimate is available, input "not applicable".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_sample_duration',
            'attr_text'=>'Wastewater Sample Duration',
            'description'=>'Duration of composite sample collected, in units of hours, e.g., 24. Specify integer values. If the sample is not a composite sample, use 0.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_sample_matrix',
            'attr_text'=>'Wastewater Sample Matrix',
            'description'=>'The wastewater matrix that was sampled',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_sample_type',
            'attr_text'=>'Wastewater Sample Type',
            'description'=>'Type of wastewater sample collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1',
            'attr_text'=>'Wastewater Surveillance Target',
            'description'=>'Taxonomic name of the surveillance target. For the COVID-19 response, use "SARS-CoV-2".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_known_present',
            'attr_text'=>'Wastewater Surveillance Target Known Present',
            'description'=>'Is genetic material of the surveillance target(s) known to the submitter to be present in this wastewater sample? Presence defined as microbiological evidence of the target organism in the wastewater sample, such as genetic- or culture-based detection.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'biological_replicate',
            'attr_text'=>'Biological Replicate',
            'description'=>'Biological replicate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'antibody',
            'attr_text'=>'Antibody',
            'description'=>'Antibody name, provider name, lot number, if used.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'affection_status',
            'attr_text'=>'Affection Status',
            'description'=>'Affection status',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'agrochem_addition',
            'attr_text'=>'Agrochem Addition',
            'description'=>'Addition of fertilizers, pesticides, etc. - amount and time of applications',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'air_temp_regm',
            'attr_text'=>'Air Temperature Regimen',
            'description'=>'Information about treatment involving an exposure to varying temperatures; should include the temperature, treatment duration, interval and total experimental duration; can include different temperature regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'al_sat',
            'attr_text'=>'Aluminium Saturation',
            'description'=>'Aluminum saturation (esp. for tropical soils)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'al_sat_meth',
            'attr_text'=>'Aluminium Saturation Method',
            'description'=>'Reference or method used in determining Al saturation',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'alkalinity',
            'attr_text'=>'Alkalinity',
            'description'=>'Alkalinity, the ability of a solution to neutralize acids to the equivalence point of carbonate or bicarbonate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'alkyl_diethers',
            'attr_text'=>'Alkyl Diethers',
            'description'=>'Concentration of alkyl diethers',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'aminopept_act',
            'attr_text'=>'Aminopeptidase Activity',
            'description'=>'Measurement of aminopeptidase activity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ammonium',
            'attr_text'=>'Ammonium',
            'description'=>'Concentration of ammonium',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'amniotic_fluid_color',
            'attr_text'=>'Amniotic Fluid Color',
            'description'=>'Specification of the color of the amniotic fluid sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'analyte_type',
            'attr_text'=>'Analyte Type',
            'description'=>'Analyte type',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'anamorph',
            'attr_text'=>'Anamorph',
            'description'=>'Genus and species of the asexually reproducing stage of fungi - note that anamorph and teleomorph forms of the same taxon may have used taxonomic different names.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'annual_season_precpt',
            'attr_text'=>'Annual Season Precipitation',
            'description'=>'Mean annual and seasonal precipitation (mm)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'annual_season_temp',
            'attr_text'=>'Annual Season Temperature',
            'description'=>'Mean annual and seasonal temperature (degree C)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'antibiotic_regm',
            'attr_text'=>'Antibiotic Regimen',
            'description'=>'Information about treatment involving antibiotic administration; should include the name of antibiotic, amount administered, treatment duration, interval and total experimental duration; can include multiple antibiotic regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'antiviral_treatment_agent',
            'attr_text'=>'Antiviral Treatment Agent',
            'description'=>'Antiviral treatment agent',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'atmospheric_data',
            'attr_text'=>'Atmospheric Data',
            'description'=>'Measurement of atmospheric data; can include multiple data',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'authority',
            'attr_text'=>'Authority',
            'description'=>'Authority for the species identification.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bac_prod',
            'attr_text'=>'Bacterial Production',
            'description'=>'Bacterial production in the water column measured by isotope uptake',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bac_resp',
            'attr_text'=>'Bacterial Respiration',
            'description'=>'Measurement of bacterial respiration in the water column',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bacteria_carb_prod',
            'attr_text'=>'Bacterial Carbon Production',
            'description'=>'Measurement of bacterial carbon production',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'barometric_press',
            'attr_text'=>'Barometric Pressure',
            'description'=>'Force per unit area exerted against a surface by the weight of air above that surface',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bio_material',
            'attr_text'=>'Biological Material',
            'description'=>'Identifier for the biological material from which the nucleic acid sequenced was obtained.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'biochem_oxygen_dem',
            'attr_text'=>'Biochemical Oxygen Demand',
            'description'=>'A measure of the relative oxygen-depletion effect of a waste contaminant',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'biomass',
            'attr_text'=>'Biomass',
            'description'=>'Amount of biomass; should include the name for the part of biomass measured, e.g. microbial, total. can include multiple measurements',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'biotic_relationship',
            'attr_text'=>'Biotic Relationship',
            'description'=>'Free-living or from host (define relationship)',
            'input_type_id'=>3,
            'list_value'=>', free living, parasite, commensal, symbiont',
        ]);
        Attributesample::create([
            'attr_name'=>'biovar',
            'attr_text'=>'Biovar',
            'description'=>'A biovar is a variant prokaryotic strain that differs physiologically and/or biochemically from other strains in a particular species.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'birth_control',
            'attr_text'=>'Birth Control',
            'description'=>'Specification of birth control medication used',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'birth_date',
            'attr_text'=>'Birth Date',
            'description'=>'Birth date',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'birth_location',
            'attr_text'=>'Birth Location',
            'description'=>'Birth location',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bishomohopanol',
            'attr_text'=>'Bishomohopanol',
            'description'=>'Concentration of bishomohopanol',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'blood_blood_disord',
            'attr_text'=>'Blood Disorder',
            'description'=>'History of blood disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'blood_press_diast',
            'attr_text'=>'Blood Pressure Diastolic',
            'description'=>'Resting diastolic blood pressure, measured as mm mercury',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'blood_press_syst',
            'attr_text'=>'Blood Pressure Systolic',
            'description'=>'Resting systolic blood pressure, measured as mm mercury',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'body_habitat',
            'attr_text'=>'Body Habitat',
            'description'=>'Original body habitat where the sample was obtained from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'body_mass_index',
            'attr_text'=>'Body Mass Index',
            'description'=>'Body mass index, calculated as weight/(height)squared',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'body_product',
            'attr_text'=>'Body Product',
            'description'=>'Substance produced by the plant where the sample was obtained from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'breeding_history',
            'attr_text'=>'Breeding History',
            'description'=>'Breeding history',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'breeding_method',
            'attr_text'=>'Breeding Method',
            'description'=>'Breeding method',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'bromide',
            'attr_text'=>'Bromide',
            'description'=>'Concentration of bromide',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'calcium',
            'attr_text'=>'Calcium',
            'description'=>'Concentration of calcium',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'carb_monoxide',
            'attr_text'=>'Carbon Monoxide',
            'description'=>'Carbon monoxide (gas) amount or concentration at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'carb_nitro_ratio',
            'attr_text'=>'Carbon Nitrogen Ratio',
            'description'=>'Ratio of amount or concentrations of carbon to nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cell_line',
            'attr_text'=>'Cell Line',
            'description'=>'Name of the cell line.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cell_subtype',
            'attr_text'=>'Cell Subtype',
            'description'=>'Cell subtype',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cell_type',
            'attr_text'=>'Cell Type',
            'description'=>'Type of cell of the sample or from which the sample was obtained.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'chem_administration',
            'attr_text'=>'Chemical Administration',
            'description'=>'List of chemical compounds administered to the host or site where sampling occurred, and when (e.g. antibiotics, N fertilizer, air filter); can include multiple compounds. For Chemical Entities of Biological Interest ontology (CHEBI) (v1.72), please see <a href="http://bioportal.bioontology.org/visualize/44603">this list</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'chem_mutagen',
            'attr_text'=>'Chemical Mutagen',
            'description'=>'Treatment involving use of mutagens; should include the name of mutagen, amount administered, treatment duration, interval and total experimental duration; can include multiple mutagen regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'chem_oxygen_dem',
            'attr_text'=>'Chemical Oxygen Demand',
            'description'=>'A measure of the relative oxygen-depletion effect of a waste contaminant',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'child_of',
            'attr_text'=>'Child of/Derived from',
            'description'=>'Indicates parentage; only applicable to sexual organisms, for bacteria use "derived from"',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'chloride',
            'attr_text'=>'Chloride',
            'description'=>'Concentration of chloride',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'chlorophyll',
            'attr_text'=>'Chlorophyll',
            'description'=>'Concentration of chlorophyll',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'climate_environment',
            'attr_text'=>'Climate Environment',
            'description'=>'Treatment involving an exposure to a particular climate; can include multiple climates',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'clone',
            'attr_text'=>'Clone',
            'description'=>'Name for the clone or subculture from which the sample was taken.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'clone_lib',
            'attr_text'=>'Clone Library',
            'description'=>'Formal identifier that points to source institute and clone library identifier.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'collection_device',
            'attr_text'=>'Collection Device',
            'description'=>'Instrument or container used to collect sample, e.g., swab',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'collection_method',
            'attr_text'=>'Collection Method',
            'description'=>'Process used to collect the sample, e.g., bronchoalveolar lavage (BAL)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'component_organism',
            'attr_text'=>'Component Organism',
            'description'=>'A component organism of the mixed sample; use the full taxonomic name, eg, "Bordetella pertussis"',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'conduc',
            'attr_text'=>'Electrical Conductivity',
            'description'=>'Electrical conductivity of water',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'crop_rotation',
            'attr_text'=>'Crop Rotation',
            'description'=>'Whether or not crop is rotated, and if yes, rotation schedule',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'culture_collection',
            'attr_text'=>'Culture Collection',
            'description'=>'Name of source institute and unique culture identifier. See the description for the proper format and <a href="http://www.insdc.org/controlled-vocabulary-culturecollection-qualifier">list of allowed institutes</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cur_land_use',
            'attr_text'=>'Current Land Use',
            'description'=>'Present state of sample site',
            'input_type_id'=>3,
            'list_value'=>', cities, farmstead, industrial areas, roads/railroads, rock, sand, gravel, mudflats, salt flats, badlands, permanent snow or ice, saline seeps, mines/quarries, oil waste areas, small grains, row crops, vegetable crops, horticultural plants (e.g. tulips), marshlands (grass,sedges,rushes), tundra (mosses,lichens), rangeland, pastureland (grasslands used for livestock grazing), hayland, meadows (grasses,alfalfa,fescue,bromegrass,timothy), shrub land (e.g. mesquite,sage-brush,creosote bush,shrub oak,eucalyptus), successional shrub land (tree saplings,hazels,sumacs,chokecherry,shrub dogwoods,blackberries), shrub crops (blueberries,nursery ornamentals,filberts), vine crops (grapes), conifers (e.g. pine,spruce,fir,cypress), hardwoods (e.g. oak,hickory,elm,aspen), intermixed hardwood and conifers, tropical (e.g. mangrove,palms), rainforest (evergreen forest receiving >406 cm annual rainfall), swamp (permanent or semi-permanent water body dominated by woody plants), crop trees (nuts,fruit,christmas trees,nursery trees)',
        ]);
        Attributesample::create([
            'attr_name'=>'cur_vegetation',
            'attr_text'=>'Current Vegetation',
            'description'=>'Vegetation classification from one or more standard classification systems, or agricultural crop',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'cur_vegetation_meth',
            'attr_text'=>'Current Vegetation Method',
            'description'=>'Reference or method used in vegetation classification',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'date_of_prior_antiviral_treat',
            'attr_text'=>'Date of Prior Antiviral Treatment',
            'description'=>'Date of the SARS-CoV-2 antiviral treatment, e.g., 2021-03-30',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'date_of_prior_sars_cov_2_infection',
            'attr_text'=>'Date of Prior SARS-CoV-2 Infection',
            'description'=>'Date of the prior SARS-CoV-2 infection, e.g., 2021-03-30',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'date_of_sars_cov_2_vaccination',
            'attr_text'=>'Date of SARS-CoV-2 Vaccination',
            'description'=>'Date of the 1st dose of the SARS-CoV-2 vaccine, e.g., 2021-03-30',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'death_date',
            'attr_text'=>'Death Date',
            'description'=>'Death date',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'density',
            'attr_text'=>'Density',
            'description'=>'Density of sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'dermatology_disord',
            'attr_text'=>'Dermatology Disorder',
            'description'=>'History of dermatology disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'dew_point',
            'attr_text'=>'Dew Point',
            'description'=>'Temperature to which a given parcel of humid air must be cooled, at constant barometric pressure, for water vapor to condense into water.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diet_last_six_month',
            'attr_text'=>'Diet Last Six Month',
            'description'=>'Specification of major diet changes in the last six months, if yes the change should be specified',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diether_lipids',
            'attr_text'=>'Diether Lipids',
            'description'=>'Concentration of diether lipids; can include multiple types of diether lipids',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'disease',
            'attr_text'=>'Disease',
            'description'=>'Name of relevant disease.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'disease_stage',
            'attr_text'=>'Disease Stage',
            'description'=>'Stage of disease at the time of sampling.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_carb_dioxide',
            'attr_text'=>'Dissolved Carbon Dioxide',
            'description'=>'Concentration of dissolved carbon dioxide',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_hydrogen',
            'attr_text'=>'Dissolved Hydrogen',
            'description'=>'Concentration of dissolved hydrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_inorg_carb',
            'attr_text'=>'Dissolved Inorganic Carbon',
            'description'=>'Dissolved inorganic carbon concentration',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_inorg_nitro',
            'attr_text'=>'Dissolved Inorganic Nitrogen',
            'description'=>'Concentration of dissolved inorganic nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_inorg_phosp',
            'attr_text'=>'Dissolved Inorganic Phosphorus',
            'description'=>'Concentration of dissolved inorganic phosphorus',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_org_carb',
            'attr_text'=>'Dissolved Organic Carbon',
            'description'=>'Concentration of dissolved organic carbon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_org_nitro',
            'attr_text'=>'Dissolved Organic Nitrogen',
            'description'=>'Dissolved organic nitrogen concentration measured as; total dissolved nitrogen - NH<span class="sub">4</span> - NO<span class="sub">3</span> - NO<span class="sub">2</span>',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'diss_oxygen',
            'attr_text'=>'Dissolved Oxygen',
            'description'=>'Concentration of dissolved oxygen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'dominant_hand',
            'attr_text'=>'Dominant Hand',
            'description'=>'Dominant hand of the subject',
            'input_type_id'=>3,
            'list_value'=>', left, right, ambidextrous',
        ]);
        Attributesample::create([
            'attr_name'=>'douche',
            'attr_text'=>'Douche',
            'description'=>'Date of most recent douche',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'down_par',
            'attr_text'=>'Down Par',
            'description'=>'Visible waveband radiance and irradiance measurements in the water column',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'drainage_class',
            'attr_text'=>'Drainage Classification',
            'description'=>'Drainage classification from a standard system such as the USDA system',
            'input_type_id'=>3,
            'list_value'=>', very poorly, poorly, somewhat poorly, moderately well, well, excessively drained',
        ]);
        Attributesample::create([
            'attr_name'=>'drug_usage',
            'attr_text'=>'Drug Usage',
            'description'=>'Any drug used by subject and the frequency of usage; can include multiple drugs used',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'dry_mass',
            'attr_text'=>'Dry Mass',
            'description'=>'Measurement of dry mass',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'efficiency_percent',
            'attr_text'=>'Efficiency Percent',
            'description'=>'Percentage of volatile solids removed from the anaerobic digestor',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'emulsions',
            'attr_text'=>'Emulsions',
            'description'=>'Amount or concentration of substances such as paints, adhesives, mayonnaise, hair colorants, emulsified oils, etc.; can include multiple emulsion types',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'encoded_traits',
            'attr_text'=>'Encoded Traits',
            'description'=>'Traits like antibiotic resistance/xenobiotic degration phenotypes/converting phage genes',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'env_package',
            'attr_text'=>'Environmental Package',
            'description'=>'MIGS/MIMS/MIENS extension for reporting of measurements and observations obtained from one or more of the environments where the sample was obtained. All environmental packages listed here are further defined in separate subtables. By giving the name of the environmental package, a selection of fields can be made from the subtables and can be reported',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'estimated_size',
            'attr_text'=>'Estimated Size',
            'description'=>'Estimated size of genome',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ethnicity',
            'attr_text'=>'Ethnicity',
            'description'=>'Ethnicity of the subject',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'experimental_factor',
            'attr_text'=>'Experimental Factor',
            'description'=>'Variable aspect of experimental design',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'exposure_event',
            'attr_text'=>'Exposure Event',
            'description'=>'Event leading to exposure, e.g., mass gathering',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'extrachrom_elements',
            'attr_text'=>'Extrachromosomal Elements',
            'description'=>'Plasmids that have significance phenotypic consequence',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'extreme_event',
            'attr_text'=>'Extreme Events',
            'description'=>'Unusual physical events that may have affected microbial populations',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'extreme_salinity',
            'attr_text'=>'Extreme Salinity',
            'description'=>'Measured salinity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'family_id',
            'attr_text'=>'Family Id',
            'description'=>'Family id',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'family_relationship',
            'attr_text'=>'Family Relationship',
            'description'=>'Relationships to other hosts in the same study; can include multiple relationships',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'fao_class',
            'attr_text'=>'FAO Classification',
            'description'=>'Soil classification from the FAO World Reference Database for Soil Resources',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'fertilizer_regm',
            'attr_text'=>'Fertilizer Regimen',
            'description'=>'Information about treatment involving the use of fertilizers; should include the name fertilizer, amount administered, treatment duration, interval and total experimental duration; can include multiple fertilizer regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'fire',
            'attr_text'=>'Fire',
            'description'=>'Historical and/or physical evidence of fire',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'flooding',
            'attr_text'=>'Flooding',
            'description'=>'Historical and/or physical evidence of flooding',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'fluor',
            'attr_text'=>'Fluorescence',
            'description'=>'Raw or converted fluorescence of water',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'foetal_health_stat',
            'attr_text'=>'Foetal Health Status',
            'description'=>'Specification of foetal health status, should also include abortion',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'forma',
            'attr_text'=>'Forma',
            'description'=>'Taxonomy level below subspecies (or variety in botany). Use is similar to ecotype etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'forma_specialis',
            'attr_text'=>'Forma Specialis',
            'description'=>'Usually applied to fungus adapted to a specific host.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'fungicide_regm',
            'attr_text'=>'Fungicide Regimen',
            'description'=>'Information about treatment involving use of fungicides; should include the name of fungicide, amount administered, treatment duration, interval and total experimental duration; can include multiple fungicide regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gaseous_environment',
            'attr_text'=>'Gaseous Environment',
            'description'=>'Use of conditions with differing gaseous environments; should include the name of gaseous compound, amount administered, treatment duration, interval and total experimental duration; can include multiple gaseous environment regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gaseous_substances',
            'attr_text'=>'Gaseous Substances',
            'description'=>'Amount or concentration of substances such as hydrogen sulfide, carbon dioxide, methane, etc.; can include multiple substances',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gastrointest_disord',
            'attr_text'=>'Gastrointestinal Disorder',
            'description'=>'History of gastrointestinal tract disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'genetic_modification',
            'attr_text'=>'Genetic Modification',
            'description'=>'Genetic modification',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'genotype',
            'attr_text'=>'Genotype',
            'description'=>'Observed genotype',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'geo_loc_exposure',
            'attr_text'=>'Location of Exposure',
            'description'=>'The country where the host was likely exposed to the causative agent of the illness. This location pertains to the country the host was believed to be exposed, and may not be the same as the host\'s country of residence, e.g., Canada',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gestation_state',
            'attr_text'=>'Gestation State',
            'description'=>'Specification of the gestation state',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gisaid_accession',
            'attr_text'=>'GISAID Accession',
            'description'=>'The GISAID accession assigned to the sequence. GISAID Accession Numbers are used as unique and permanent identifiers for each virus beginning with the letters EPI and followed by numbers, to identify viruses and/or segments; https://www.gisaid.org/; e.g., EPI_ISL_1091361',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gisaid_virus_name',
            'attr_text'=>'GISAID Virus Name',
            'description'=>'The full virus name submitted to GISAID (https://www.gisaid.org/), e.g., hCoV-19/Belgium/rega-3187/2021',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'glucosidase_act',
            'attr_text'=>'Glucosidase Activity',
            'description'=>'Measurement of glucosidase activity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gravidity',
            'attr_text'=>'Gravidity',
            'description'=>'Whether or not subject is gravid, and if yes date due or date post-conception, specifying which is used',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gravity',
            'attr_text'=>'Gravity',
            'description'=>'Information about treatment involving use of gravity factor to study various types of responses in presence, absence or modified levels of gravity; can include multiple treatments',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'growth_hormone_regm',
            'attr_text'=>'Growth Hormone Regimen',
            'description'=>'Information about treatment involving use of growth hormones; should include the name of growth hormone, amount administered, treatment duration, interval and total experimental duration; can include multiple growth hormone regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'growth_med',
            'attr_text'=>'Growth Media',
            'description'=>'Information about growth media for growing the plants or tissue cultured samples',
            'input_type_id'=>3,
            'list_value'=>', soil, liquid',
        ]);
        Attributesample::create([
            'attr_name'=>'growth_protocol',
            'attr_text'=>'Growth Protocol',
            'description'=>'Free-text growth protocol',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'gynecologic_disord',
            'attr_text'=>'Gynecological Disorder',
            'description'=>'History of gynecological disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'haplotype',
            'attr_text'=>'Haplotype',
            'description'=>'Name of the haplotype. Primarily used for identification. A combination of alleles at multiple loci on the same chromosome that are closely linked and tend to be inherited as a unit.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'health_state',
            'attr_text'=>'Health State',
            'description'=>'Health or disease status of sample at time of collection',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'heavy_metals',
            'attr_text'=>'Heavy Metals',
            'description'=>'Heavy metals present and concentrations of any drug used by subject and the frequency of usage; can include multiple heavy metals and concentrations',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'heavy_metals_meth',
            'attr_text'=>'Heavy Metals Method',
            'description'=>'Reference or method used in determining heavy metals',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'height_or_length',
            'attr_text'=>'Height or Length',
            'description'=>'Measurement of height or length',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'herbicide_regm',
            'attr_text'=>'Herbicide Regimen',
            'description'=>'Information about treatment involving use of herbicides; information about treatment involving use of growth hormones; should include the name of herbicide, amount administered, treatment duration, interval and total experimental duration; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'histological_type',
            'attr_text'=>'Histological Type',
            'description'=>'Histological type',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'hiv_stat',
            'attr_text'=>'HIV Status',
            'description'=>'HIV status of subject, if yes HAART initiation status should also be indicated as [YES or NO]',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'horizon',
            'attr_text'=>'Horizon',
            'description'=>'Specific layer in the land area which measures parallel to the soil surface and possesses physical characteristics which differ from the layers above and beneath',
            'input_type_id'=>3,
            'list_value'=>', O horizon, A horizon, E horizon, B horizon, C horizon, R layer, Permafrost',
        ]);
        Attributesample::create([
            'attr_name'=>'horizon_meth',
            'attr_text'=>'Horizon Method',
            'description'=>'Reference or method used in determining the horizon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_age',
            'attr_text'=>'Host Age',
            'description'=>'Age of host at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_anatomical_material',
            'attr_text'=>'Host Anatomical Material',
            'description'=>'Host anatomical material or substance produced by the body where the sample was obtained, e.g., stool, mucus, saliva',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_anatomical_part',
            'attr_text'=>'Host Anatomical Part',
            'description'=>'Anatomical part of the host organism (e.g. tissue) that was sampled, e.g., nasopharynx',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_blood_press_diast',
            'attr_text'=>'Host Blood Pressure Diastolic',
            'description'=>'Resting diastolic blood pressureof the host, measured as mm mercury',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_blood_press_syst',
            'attr_text'=>'Host Blood Pressure Systolic',
            'description'=>'Resting systolic blood pressure of the host, measured as mm mercury',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_body_habitat',
            'attr_text'=>'Host Body Habitat',
            'description'=>'Original body habitat where the sample was obtained from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_body_mass_index',
            'attr_text'=>'Host Body Mass Index',
            'description'=>'Body mass index of the host, calculated as weight/(height) squared',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_body_product',
            'attr_text'=>'Host Body Product',
            'description'=>'Substance produced by the host, e.g. stool, mucus, where the sample was obtained from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_body_temp',
            'attr_text'=>'Host Body Temperature',
            'description'=>'Core body temperature of the host when sample was collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_color',
            'attr_text'=>'Host Color',
            'description'=>'The color of host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_description',
            'attr_text'=>'Host Description',
            'description'=>'Additional information not included in other defined vocabulary fields',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_diet',
            'attr_text'=>'Host Diet',
            'description'=>'Type of diet depending on the sample for animals omnivore, herbivore etc., for humans high-fat, meditteranean etc.; can include multiple diet types',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease_outcome',
            'attr_text'=>'Host Disease Outcome',
            'description'=>'Final outcome of disease, e.g., death, chronic disease, recovery',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_disease_stage',
            'attr_text'=>'Host Disease Stage',
            'description'=>'Stage of disease at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_dry_mass',
            'attr_text'=>'Host Dry Mass',
            'description'=>'Measurement of dry mass',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_family_relationship',
            'attr_text'=>'Host Family Relationship',
            'description'=>'Host family relationship',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_genotype',
            'attr_text'=>'Host Genotype',
            'description'=>'Host genotype',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_growth_cond',
            'attr_text'=>'Host Growth Conditions',
            'description'=>'Literature reference giving growth conditions of the host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_health_state',
            'attr_text'=>'Host Health State',
            'description'=>'Information regarding health state of the individual sampled at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_height',
            'attr_text'=>'Host Height',
            'description'=>'The height of subject',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_hiv_stat',
            'attr_text'=>'Host HIV Status',
            'description'=>'HIV status of subject, if yes HAART initiation status should also be indicated as [YES or NO]',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_infra_specific_name',
            'attr_text'=>'Host Infra Specific Name',
            'description'=>'Taxonomic information subspecies level',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_infra_specific_rank',
            'attr_text'=>'Host Infra Specific Rank',
            'description'=>'Taxonomic rank information below subspecies level, such as variety, form, rank etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_last_meal',
            'attr_text'=>'Host Last Meal',
            'description'=>'Content of last meal and time since feeding; can include multiple values',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_length',
            'attr_text'=>'Host Length',
            'description'=>'The length of subject',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_life_stage',
            'attr_text'=>'Host Life Stage',
            'description'=>'Description of host life stage',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_occupation',
            'attr_text'=>'Host Occupation',
            'description'=>'Most frequent job performed by subject',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_phenotype',
            'attr_text'=>'Host Phenotype',
            'description'=>'Host phenotype',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_pulse',
            'attr_text'=>'Host Pulse',
            'description'=>'Resting pulse of the host, measured as beats per minute',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_recent_travel_loc',
            'attr_text'=>'Host Recent Travel Location',
            'description'=>'The name of the country that was the destination of most recent travel. Specify the countries (and more granular locations if known) travelled, e.g., United Kingdom. Can include multiple travels; separate multiple travel events with a semicolon.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_recent_travel_return_date',
            'attr_text'=>'Host Recent Travel Return Date',
            'description'=>'The date of a person\'s most recent return to some residence from a journey originating at that residence, e.g., 2021-03-30',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_sex',
            'attr_text'=>'Host Sex',
            'description'=>'Gender or physical sex of the host',
            'input_type_id'=>3,
            'list_value'=>', male, female, pooled male and female, neuter, hermaphrodite, intersex, not determined, missing, not applicable, not collected',
        ]);
        Attributesample::create([
            'attr_name'=>'host_shape',
            'attr_text'=>'Host Shape',
            'description'=>'Morphological shape of host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_specimen_voucher',
            'attr_text'=>'Host Specimen Voucher',
            'description'=>'Identifier for the physical specimen. Include a URI (Uniform Resource Identifier) in the form of a URL providing a direct link to the physical host specimen. If the specimen was destroyed in the process of analysis, electronic images (e-vouchers) are an adequate substitute for a physical host voucher specimen. If a URI is not available, a museum-provided globally unique identifier (GUID) can be used. URI example: http://portal.vertnet.org/o/fmnh/mammals?id=33e55cfe-330b-40d9-aaae-8d042cba7542; INSDC triplet example: UAM:Mamm:52179',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_subject_id',
            'attr_text'=>'Host Subject Id',
            'description'=>'A unique identifier by which each subject can be referred to, de-identified, e.g. #131',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_substrate',
            'attr_text'=>'Host Substrate',
            'description'=>'The growth substrate of the host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_taxid',
            'attr_text'=>'Host Taxon Id',
            'description'=>'NCBI taxon id of the host, e.g. 9606',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_tissue_sampled',
            'attr_text'=>'Host Tissue Sampled',
            'description'=>'Type of tissue the initial sample was taken from. Controlled vocabulary, <a href="http://bioportal.bioontology.org/ontologies/1005">http://bioportal.bioontology.org/ontologies/1005</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_tot_mass',
            'attr_text'=>'Host Total Mass',
            'description'=>'Total mass of the host at collection, the unit depends on host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'host_wet_mass',
            'attr_text'=>'Host Wet Mass',
            'description'=>'Measurement of wet mass',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'hrt',
            'attr_text'=>'Hormone Replacement Theraphy',
            'description'=>'Whether subject had hormone replacement theraphy, and if yes start date',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'humidity',
            'attr_text'=>'Humidity',
            'description'=>'Amount of water vapour in the air, at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'humidity_regm',
            'attr_text'=>'Humidity Regimen',
            'description'=>'Information about treatment involving an exposure to varying degree of humidity; information about treatment involving use of growth hormones; should include amount of humidity administered, treatment duration, interval and total experimental duration; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'hysterectomy',
            'attr_text'=>'Hysterectomy',
            'description'=>'Specification of whether hysterectomy was performed',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'identified_by',
            'attr_text'=>'Identified By',
            'description'=>'Name of the taxonomist who identified the specimen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ihmc_medication_code',
            'attr_text'=>'IHMC Medication Code',
            'description'=>'Can include multiple medication codes',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'indoor_surf',
            'attr_text'=>'Indoor Surface',
            'description'=>'Type of indoor surface',
            'input_type_id'=>3,
            'list_value'=>', counter top, window, wall, cabinet, ceiling, door, shelving, vent cover',
        ]);
        Attributesample::create([
            'attr_name'=>'indust_eff_percent',
            'attr_text'=>'Industrial Effluents Percentage',
            'description'=>'Percentage of industrial effluents received by wastewater treatment plant',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'infection',
            'attr_text'=>'Infection',
            'description'=>'Infection',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'infra_specific_name',
            'attr_text'=>'Infra Specific Name',
            'description'=>'Taxonomic information about the host below subspecies level',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'infra_specific_rank',
            'attr_text'=>'Infra Specific Rank',
            'description'=>'Taxonomic rank information about the host below subspecies level, such as variety, form, rank etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'inorg_particles',
            'attr_text'=>'Inorganic Particles',
            'description'=>'Concentration of particles such as sand, grit, metal particles, ceramics, etc.; can include multiple particles',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'investigation_type',
            'attr_text'=>'Investigation Type',
            'description'=>'Nucleic Acid Sequence Report is the root element of all MIGS/MIMS compliant reports as standardized by Genomic Standards Consortium. This field is either eukaryote,bacteria,virus,plasmid,organelle, metagenome, miens-survey or miens-culture',
            'input_type_id'=>3,
            'list_value'=>', eukaryote, bacteria_archaea, plasmid, virus, organelle, metagenome, miens-survey, miens-culture',
        ]);
        Attributesample::create([
            'attr_name'=>'is_tumor',
            'attr_text'=>'Is Tumor',
            'description'=>'Is tumor',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'isolate_name_alias',
            'attr_text'=>'Isolate Name Alias',
            'description'=>'Isolate name alias',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'karyotype',
            'attr_text'=>'Karyotype',
            'description'=>'Karyotype',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'kidney_disord',
            'attr_text'=>'Kidney Disorder',
            'description'=>'History of kidney disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'label',
            'attr_text'=>'Label',
            'description'=>'A label for sample, or name of an individual animal (e.g., Clint)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'last_meal',
            'attr_text'=>'Last Meal',
            'description'=>'Content of last meal and time since feeding; can include multiple values',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'life_stage',
            'attr_text'=>'Life Stage',
            'description'=>'Description of life stage of host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'light_intensity',
            'attr_text'=>'Light Intensity',
            'description'=>'Measurement of light intensity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'link_addit_analys',
            'attr_text'=>'Link Additional Analysis',
            'description'=>'Links to additional analysis',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'link_class_info',
            'attr_text'=>'Link Class Information',
            'description'=>'Link to digitized soil maps or other soil classification information',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'link_climate_info',
            'attr_text'=>'Link Climate Information',
            'description'=>'Link to climate resource',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'liver_disord',
            'attr_text'=>'Liver Disorder',
            'description'=>'History of liver disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'local_class',
            'attr_text'=>'Local Classification',
            'description'=>'Soil classification based on local soil classification system',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'local_class_meth',
            'attr_text'=>'Local Classification Method',
            'description'=>'Reference or method used in determining the local soil classification',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'magnesium',
            'attr_text'=>'Magnesium',
            'description'=>'Concentration of magnesium',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'maternal_health_stat',
            'attr_text'=>'Maternal Health Status',
            'description'=>'Specification of the maternal health status',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'mating_type',
            'attr_text'=>'Mating Type',
            'description'=>'Mating type',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'mean_frict_vel',
            'attr_text'=>'Mean Frict Velocity',
            'description'=>'Measurement of mean friction velocity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'mean_peak_frict_vel',
            'attr_text'=>'Mean Peak Frict Velocity',
            'description'=>'Measurement of mean peak friction velocity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'mechanical_damage',
            'attr_text'=>'Mechanical Damage',
            'description'=>'Information about any mechanical damage exerted on the plant; can include multiple damages and sites',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'medic_hist_perform',
            'attr_text'=>'Medical History Perform',
            'description'=>'Whether full medical history was collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'menarche',
            'attr_text'=>'Menarche',
            'description'=>'Date of most recent menstruation',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'menopause',
            'attr_text'=>'Menopause',
            'description'=>'Date of onset of menopause',
            'input_type_id'=>4,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'methane',
            'attr_text'=>'Methane',
            'description'=>'Methane (gas) amount or concentration at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'microbial_biomass',
            'attr_text'=>'Microbial Biomass',
            'description'=>'The part of the organic matter in the soil that constitutes living microorganisms smaller than 5-10 micrometers. IF you keep this, you would need to have correction factors used for conversion to the final units, which should be mg C (or N)/kg soil).',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'microbial_biomass_meth',
            'attr_text'=>'Microbial Biomass Method',
            'description'=>'Reference or method used in determining microbial biomass',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'mineral_nutr_regm',
            'attr_text'=>'Mineral Nutrient Regimen',
            'description'=>'Information about treatment involving the use of mineral supplements; should include the name of mineral nutrient, amount administered, treatment duration, interval and total experimental duration; can include multiple mineral nutrient regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'misc_param',
            'attr_text'=>'Misc Parameter',
            'description'=>'Any other measurement performed or parameter collected, that is not listed here',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'molecular_data_type',
            'attr_text'=>'Molecular Data Type',
            'description'=>'Type of molecular (omics) data tied to this sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'morphology',
            'attr_text'=>'Morphology',
            'description'=>'Morphology',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'n_alkanes',
            'attr_text'=>'N Alkanes',
            'description'=>'Concentration of n-alkanes; can include multiple n-alkanes',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'narms_isolate_number',
            'attr_text'=>'NARMS Isolate Number',
            'description'=>'Isolate identifier for the collection of isolates in the National Antimicrobial Resistance Monitoring System, authority http://www.cdc.gov/narms/about/index.html, e.g., CVM N6429',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'nitrate',
            'attr_text'=>'Nitrate',
            'description'=>'Concentration of nitrate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'nitrite',
            'attr_text'=>'Nitrite',
            'description'=>'Concentration of nitrite',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'nitro',
            'attr_text'=>'Nitro',
            'description'=>'Concentration of nitrogen (total)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'non_mineral_nutr_regm',
            'attr_text'=>'Non Mineral Nutrient Regimen',
            'description'=>'Information about treatment involving the exposure of plant to non-mineral nutrient such as oxygen, hydrogen or carbon; should include the name of non-mineral nutrient, amount administered, treatment duration, interval and total experimental duration; can include multiple non-mineral nutrient regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'nose_mouth_teeth_throat_disord',
            'attr_text'=>'Nose Mouth Teeth Throat Disorder',
            'description'=>'History of nose/mouth/teeth/throat disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'nose_throat_disord',
            'attr_text'=>'Nose Throat Disorder',
            'description'=>'History of nose-throat disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'occupation',
            'attr_text'=>'Occupation',
            'description'=>'Most frequent job performed by subject',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'omics_observ_id',
            'attr_text'=>'Omics Observatory Id',
            'description'=>'A unique identifier of the omics-enabled observatory (or comparable time series) your data derives from. This identifier should be provided by the OMICON ontology; if you require a new identifier for your time series, contact the ontology\'s developers. Information is available here: https://github.com/GLOMICON/omicon. This field is only applicable to records which derive from an omics time-series or observatory.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'org_carb',
            'attr_text'=>'Organic Carbon',
            'description'=>'Concentration of organic carbon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'org_matter',
            'attr_text'=>'Organic Matter',
            'description'=>'Concentration of organic matter',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'org_nitro',
            'attr_text'=>'Organic Nitrogen',
            'description'=>'Concentration of organic nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'org_particles',
            'attr_text'=>'Organic Particles',
            'description'=>'Concentration of particles such as faeces, hairs, food, vomit, paper fibers, plant material, humus, etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'orgmod_note',
            'attr_text'=>'Organisme Modifier Note',
            'description'=>'Organism modifier note',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'outbreak',
            'attr_text'=>'Outbreak',
            'description'=>'Submitter designated name for an occurrence of more cases of disease than expected in a given area or among a specific group of people over a particular period of time.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'oxy_stat_samp',
            'attr_text'=>'Oxygenation Status Sample',
            'description'=>'Oxygenation status of sample',
            'input_type_id'=>3,
            'list_value'=>', aerobic, anaerobic',
        ]);
        Attributesample::create([
            'attr_name'=>'oxygen',
            'attr_text'=>'Oxygen',
            'description'=>'Oxygen (gas) amount or concentration at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'part_org_carb',
            'attr_text'=>'Particulate Organic Carbon',
            'description'=>'Concentration of particulate organic carbon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'part_org_nitro',
            'attr_text'=>'Particulate Organic Nitrogen',
            'description'=>'Concentration of particulate organic nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'particle_class',
            'attr_text'=>'Particle Classification',
            'description'=>'Particles are classified, based on their size, into six general categories: clay, silt, sand, gravel, cobbles, and boulders; should include amount of particle preceded by the name of the particle type; can include multiple values',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'passage_history',
            'attr_text'=>'Passage History',
            'description'=>'Number of passages and passage method',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'passage_method',
            'attr_text'=>'Passage Method',
            'description'=>'Description of how the organism was passaged. Provide a short description, e.g., AVL buffer+30%EtOH lysate received from Respiratory Lab. P3 passage in Vero-1 via bioreactor large-scale batch passage. P3 batch derived from the SP-2/reference lab strain. If not passaged, put ""not applicable"".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'passage_number',
            'attr_text'=>'Passage Number',
            'description'=>'The number of known passages, e.g., 3. If not passaged, put ""not applicable"".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pathogenicity',
            'attr_text'=>'Pathogenicity',
            'description'=>'To what is the entity pathogenic',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pathotype',
            'attr_text'=>'Pathotype',
            'description'=>'Some bacterial specific pathotypes (example Eschericia coli - STEC, UPEC)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pathovar',
            'attr_text'=>'Pathovar',
            'description'=>'Taxonomy below subspecies; a variety (in bacteria, fungi or virus) usually based on its pathogenic properties. Sometimes used as equivalent to subspecies.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'perturbation',
            'attr_text'=>'Perturbation',
            'description'=>'Type of perturbation, e.g. chemical administration, physical disturbance, etc., coupled with time that perturbation occurred; can include multiple perturbation types',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pesticide_regm',
            'attr_text'=>'Pesticide Regimen',
            'description'=>'Information about treatment involving use of insecticides; should include the name of pesticide, amount administered, treatment duration, interval and total experimental duration; can include multiple pesticide regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pet_farm_animal',
            'attr_text'=>'Pet Farm Animal',
            'description'=>'Specification of presence of pets or farm animals in the environment of subject, if yes the animals should be specified; can include multiple animals present',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'petroleum_hydrocarb',
            'attr_text'=>'Petroleum Hydrocarbon',
            'description'=>'Concentration of petroleum hydrocarbon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ph',
            'attr_text'=>'PH',
            'description'=>'PH measurement',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ph_meth',
            'attr_text'=>'PH Method',
            'description'=>'Reference or method used in determining pH',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ph_regm',
            'attr_text'=>'PH Regimen',
            'description'=>'Information about treatment involving exposure of plants to varying levels of pH of the growth media; can include multiple regimen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'phaeopigments',
            'attr_text'=>'Phaeopigments',
            'description'=>'Concentration of phaeopigments; can include multiple phaeopigments',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'phenotype',
            'attr_text'=>'Phenotype',
            'description'=>'Phenotype of sampled organism. For Phenotypic quality Ontology (PATO) (v1.269) terms, please see <a href="http://bioportal.bioontology.org/visualize/44601">this link</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'phosphate',
            'attr_text'=>'Phosphate',
            'description'=>'Concentration of phosphate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'phosplipid_fatt_acid',
            'attr_text'=>'Phosplipid Fatt Acid',
            'description'=>'Concentration of phospholipid fatty acids; can include multiple values',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'photon_flux',
            'attr_text'=>'Photon Flux',
            'description'=>'Measurement of photon flux',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'plant_body_site',
            'attr_text'=>'Plant Body Site',
            'description'=>'Name of body site that the sample was obtained from. For PO (v819) terms please see <a href="http://bioportal.bioontology.org/visualize/42737">this site</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'plant_product',
            'attr_text'=>'Plant Product',
            'description'=>'Substance produced by the plant, where the sample was obtained from',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ploidy',
            'attr_text'=>'Ploidy',
            'description'=>'The ploidy level of the genome (e.g. allopolyploid, haploid, diploid, triploid, tetraploid).',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pollutants',
            'attr_text'=>'Pollutants',
            'description'=>'Pollutant types and, amount or concentrations measured at the time of sampling; can report multiple pollutants by entering numeric values preceded by name of pollutant',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pool_dna_extracts',
            'attr_text'=>'Pool DNA Extracts',
            'description'=>'Were multiple DNA extractions mixed? how many?',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'population',
            'attr_text'=>'Population',
            'description'=>'For human: ; for plants: filial generation, number of progeny, genetic structure',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'population_description',
            'attr_text'=>'Population Description',
            'description'=>'The full, unabbreviated population descriptor from the Coriell Institute',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'porosity',
            'attr_text'=>'Porosity',
            'description'=>'Porosity of deposited sediment is volume of voids divided by the total volume of sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'potassium',
            'attr_text'=>'Potassium',
            'description'=>'Concentration of potassium',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pre_treatment',
            'attr_text'=>'Pre Treatment',
            'description'=>'The process of pre-treatment removes materials that can be easily collected from the raw wastewater',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pregnancy',
            'attr_text'=>'Pregnancy',
            'description'=>'Date due of pregnancy',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pressure',
            'attr_text'=>'Pressure',
            'description'=>'Pressure to which the sample is subject, in atmospheres',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'previous_land_use',
            'attr_text'=>'Previous Land Use',
            'description'=>'Previous land use and dates',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'previous_land_use_meth',
            'attr_text'=>'Previous Land Use Method',
            'description'=>'Reference or method used in determining previous land use and dates',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'primary_prod',
            'attr_text'=>'Primary Production',
            'description'=>'Measurement of primary production',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'primary_treatment',
            'attr_text'=>'Primary Treatment',
            'description'=>'The process to produce both a generally homogeneous liquid capable of being treated biologically and a sludge that can be separately treated or processed',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'prior_sars_cov_2_antiviral_treat',
            'attr_text'=>'Prior SARS-CoV-2 Antiviral Treatment',
            'description'=>'Has the host received SARS-CoV-2 antiviral treatment?',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'prior_sars_cov_2_infection',
            'attr_text'=>'Prior SARS-CoV-2 Infection',
            'description'=>'Did the host have a prior SARS-CoV-2 infection?',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'prior_sars_cov_2_vaccination',
            'attr_text'=>'Prior SARS-CoV-2 Vaccination',
            'description'=>'Has the host received a SARS-CoV-2 vaccination?',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'profile_position',
            'attr_text'=>'Profile Position',
            'description'=>'Cross-sectional position in the hillslope where sample was collected, sample area position in relation to surrounding areas',
            'input_type_id'=>3,
            'list_value'=>', summit, shoulder, backslope, footslope, toeslope',
        ]);
        Attributesample::create([
            'attr_name'=>'project_name',
            'attr_text'=>'Project Name',
            'description'=>'A concise name that describes the overall project, for example "Analysis of sequences collected from Antarctic soil"',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pulmonary_disord',
            'attr_text'=>'Pulmonary Disorder',
            'description'=>'History of pulmonary disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'pulse',
            'attr_text'=>'Pulse',
            'description'=>'Resting pulse, measured as beats per minute',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'purpose_of_sampling',
            'attr_text'=>'Purpose Of Sampling',
            'description'=>'The reason the sample was collected, e.g., diagnostic testing',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'purpose_of_sequencing',
            'attr_text'=>'Purpose Of Sequencing',
            'description'=>'The reason the sample was sequenced, e.g., baseline surveillance (random sampling)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'purpose_of_ww_sampling',
            'attr_text'=>'Purpose of Wastewater Sampling',
            'description'=>'The reason the sample was collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'purpose_of_ww_sequencing',
            'attr_text'=>'Purpose of Wastewater Sequencing',
            'description'=>'The reason the sample was sequenced, e.g., identification of mutations within a specific region, presence of clinically known mutations, or diversity of mutations across entire genome',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'race',
            'attr_text'=>'Race',
            'description'=>'Race',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'radiation_regm',
            'attr_text'=>'Radiation Regimen',
            'description'=>'Information about treatment involving exposure of plant or a plant part to a particular radiation regimen; should include the radiation type, amount or intensity administered, treatment duration, interval and total experimental duration; can include multiple radiation regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'rainfall_regm',
            'attr_text'=>'Rainfall Regimen',
            'description'=>'Information about treatment involving an exposure to a given amount of rainfall; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'reactor_type',
            'attr_text'=>'Reactor Type',
            'description'=>'Anaerobic digesters can be designed and engineered to operate using a number of different process configurations, as batch or continuous, mesophilic, high solid or low solid, and single stage or multistage',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'redox_potential',
            'attr_text'=>'Redox Potential',
            'description'=>'Redox potential, measured relative to a hydrogen cell, indicating oxidation or reduction potential',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'reference_material',
            'attr_text'=>'Reference Material',
            'description'=>'Indicates that a standards body or external group asserts this sample is reference material, eg, "NIST reference material for genome sequencing validation".',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'rel_to_oxygen',
            'attr_text'=>'Rel To Oxygen',
            'description'=>'Aerobic or anaerobic',
            'input_type_id'=>3,
            'list_value'=>', aerobe, anaerobe, facultative, microaerophilic, microanaerobe, obligate aerobe, obligate anaerobe',
        ]);
        Attributesample::create([
            'attr_name'=>'repository',
            'attr_text'=>'Repository',
            'description'=>'Repository',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'resp_part_matter',
            'attr_text'=>'Resp Part Matter',
            'description'=>'Concentration of substances that remain suspended in the air, and comprise mixtures of organic and inorganic substances (PM10 and PM2.5); can report multiple PM\'s by entering numeric values preceded by name of PM',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'risk_group',
            'attr_text'=>'Risk Group',
            'description'=>'Risk group',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'salinity',
            'attr_text'=>'Salinity',
            'description'=>'Salinity measurement',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'salinity_meth',
            'attr_text'=>'Salinity Method',
            'description'=>'Reference or method used in determining salinity',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'salt_regm',
            'attr_text'=>'Salt Regimen',
            'description'=>'Information about treatment involving use of salts as supplement to liquid and soil growth media; should include the name of salt, amount administered, treatment duration, interval and total experimental duration; can include multiple salt regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'same_as',
            'attr_text'=>'Same As',
            'description'=>'Indicates that the same physical sample has multiple BioSample records',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_collect_device',
            'attr_text'=>'Sample Collect Device',
            'description'=>'Method or device employed for collecting sample',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_mat_process',
            'attr_text'=>'Sample Mat Process',
            'description'=>'Processing applied to the sample during or after isolation',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_salinity',
            'attr_text'=>'Sample Salinity',
            'description'=>'Salinity of sample, i.e. measure of total salt concentration',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_size',
            'attr_text'=>'Sample Size',
            'description'=>'Amount or size of sample (volume, mass or area) that was collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_sort_meth',
            'attr_text'=>'Sample Sort Method',
            'description'=>'Method by which samples are sorted',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_store_dur',
            'attr_text'=>'Sample Store Duration',
            'description'=>'Duration for which sample was stored',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_store_loc',
            'attr_text'=>'Sample Store Location',
            'description'=>'Location at which sample was stored, usually name of a specific freezer/room',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_store_temp',
            'attr_text'=>'Sample Store Temperature',
            'description'=>'Temperature at which sample was stored, e.g. -80',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'samp_vol_we_dna_ext',
            'attr_text'=>'Sample Vol Weight DNA Ext',
            'description'=>'Weight (g) of soil processed',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sars_cov_2_diag_gene_name_1',
            'attr_text'=>'SARS-CoV-2 Diagnostic Gene Name 1',
            'description'=>'The name of the gene used in the first diagnostic SARS-CoV-2 RT-PCR test.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sars_cov_2_diag_gene_name_2',
            'attr_text'=>'SARS-CoV-2 Diagnostic Gene Name 2',
            'description'=>'The name of the gene used in the second diagnostic SARS-CoV-2 RT-PCR test.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sars_cov_2_diag_pcr_ct_value_1',
            'attr_text'=>'SARS-CoV-2 Diagnostic PCR CT Value 1',
            'description'=>'The cycle threshold (CT) value result from the first diagnostic SARS-CoV-2 RT-PCR test, e.g., 21',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sars_cov_2_diag_pcr_ct_value_2',
            'attr_text'=>'SARS-CoV-2 Diagnostic PCR CT Value 2',
            'description'=>'The cycle threshold (CT) value result from the second diagnostic SARS-CoV-2 RT-PCR test, e.g., 36',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'season_environment',
            'attr_text'=>'Season Environment',
            'description'=>'Treatment involving an exposure to a particular season (e.g. winter, summer, rabi, rainy etc.)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'secondary_treatment',
            'attr_text'=>'Secondary Treatment',
            'description'=>'The process for substantially degrading the biological content of the sewage',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sediment_type',
            'attr_text'=>'Sediment Type',
            'description'=>'Information about the sediment type based on major constituents',
            'input_type_id'=>3,
            'list_value'=>', biogenous, cosmogenous, hydrogenous, lithogenous',
        ]);
        Attributesample::create([
            'attr_name'=>'sequenced_by',
            'attr_text'=>'Sequenced By',
            'description'=>'The name of the agency that generated the sequence, e.g., Centers for Disease Control and Prevention',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'serogroup',
            'attr_text'=>'Serogroup',
            'description'=>'Serogroup',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'serotype',
            'attr_text'=>'Serotype',
            'description'=>'Taxonomy below subspecies; a variety (in bacteria, fungi or virus) usually based on its antigenic properties. Same as serovar and serogroup. e.g. serotype="H1N1" in Influenza A virus CY098518.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'serovar',
            'attr_text'=>'Serovar',
            'description'=>'Taxonomy below subspecies; a variety (in bacteria, fungi or virus) usually based on its antigenic properties. Same as serovar and serotype. Sometimes used as species identifier in bacteria with shaky taxonomy, e.g. <a href="http://www.ncbi.nlm.nih.gov/Taxonomy/Browser/wwwtax.cgi?mode=Info&id=176&lvl=3&lin=f&srchmode=3&unlock">Leptospira interrogans serovar Hardjo</a>',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sewage_type',
            'attr_text'=>'Sewage Type',
            'description'=>'Type of wastewater treatment plant as municipial or industrial',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sexual_act',
            'attr_text'=>'Sexual Act',
            'description'=>'Current sexual partner and frequency of sex',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sieving',
            'attr_text'=>'Sieving',
            'description'=>'Collection design of pooled samples and/or sieve size and amount of sample sieved',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'silicate',
            'attr_text'=>'Silicate',
            'description'=>'Concentration of silicate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'size_frac',
            'attr_text'=>'Size Frac',
            'description'=>'Filtering pore size used in sample preparation, e.g., 0-0.22 micrometer',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'slope_aspect',
            'attr_text'=>'Slope Aspect',
            'description'=>'The direction a slope faces. While looking down a slope use a compass to record the direction you are facing (direction or degrees); e.g., NW or 315&deg;. This measure provides an indication of sun and wind exposure that will influence soil temperature and evapotranspiration.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'slope_gradient',
            'attr_text'=>'Slope Gradient',
            'description'=>'Commonly called "slope". The angle between ground surface and a horizontal line (in percent). This is the direction that overland water would flow. This measure is usually taken with a hand level meter or clinometer.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sludge_retent_time',
            'attr_text'=>'Sludge Retent Time',
            'description'=>'The time activated sludge remains in reactor',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'smoker',
            'attr_text'=>'Smoker',
            'description'=>'Specification of smoking status',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sodium',
            'attr_text'=>'Sodium',
            'description'=>'Sodium concentration',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'soil_type',
            'attr_text'=>'Soil Type',
            'description'=>'Soil series name or other lower-level classification',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'soil_type_meth',
            'attr_text'=>'Soil Type Method',
            'description'=>'Reference or method used in determining soil series name or other lower-level classification',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'solar_irradiance',
            'attr_text'=>'Solar Irradiance',
            'description'=>'The amount of solar energy that arrives at a specific area of a surface during a specific time interval',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'soluble_inorg_mat',
            'attr_text'=>'Soluble Inorganic Material',
            'description'=>'Concentration of substances such as ammonia, road-salt, sea-salt, cyanide, hydrogen sulfide, thiocyanates, thiosulfates, etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'soluble_org_mat',
            'attr_text'=>'Soluble Organic Material',
            'description'=>'Concentration of substances such as urea, fruit sugars, soluble proteins, drugs, pharmaceuticals, etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'soluble_react_phosp',
            'attr_text'=>'Soluble React Phosphorus',
            'description'=>'Concentration of soluble reactive phosphorus',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'source_material_id',
            'attr_text'=>'Source Material Id',
            'description'=>'Unique identifier assigned to a material sample used for extracting nucleic acids, and subsequent sequencing. The identifier can refer either to the original material collected or to any derived sub-samples.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'source_name',
            'attr_text'=>'Source Name',
            'description'=>'Sample source name or description',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'special_diet',
            'attr_text'=>'Special Diet',
            'description'=>'Specification of special diet; can include multiple special diets',
            'input_type_id'=>3,
            'list_value'=>', low carb, reduced calorie, vegetarian, other(to be specified)',
        ]);
        Attributesample::create([
            'attr_name'=>'specimen_voucher',
            'attr_text'=>'Specimen Voucher',
            'description'=>'Identifier for the physical specimen. Use format: "[&lt;institution-code&gt;:[&lt;collection-code&gt;:]]&lt;specimen_id&gt;", eg, "UAM:Mamm:52179". Intended as a reference to the physical specimen that remains after it was analyzed. If the specimen was destroyed in the process of analysis, electronic images (e-vouchers) are an adequate substitute for a physical voucher specimen. Ideally the specimens will be deposited in a curated museum, herbarium, or frozen tissue collection, but often they will remain in a personal or laboratory collection for some time before they are deposited in a curated collection. There are three forms of specimen_voucher qualifiers. If the text of the qualifier includes one or more colons it is a "structured voucher". Structured vouchers include institution-codes (and optional collection-codes) taken from a controlled vocabulary maintained by the INSDC that denotes the museum or herbarium collection where the specimen resides, please visit <a href="http://www.insdc.org/controlled-vocabulary-specimenvoucher-qualifier">the INSDC website</a>.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'standing_water_regm',
            'attr_text'=>'Standing Water Regimen',
            'description'=>'Treatment involving an exposure to standing water during a plant\'s life span, types can be flood water or standing water; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'store_cond',
            'attr_text'=>'Store Condition',
            'description'=>'Explain how and for how long the soil sample was stored before DNA extraction.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'stress',
            'attr_text'=>'Stress',
            'description'=>'Stress',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'stud_book_number',
            'attr_text'=>'Stud Book Number',
            'description'=>'Stud book number',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'study_complt_stat',
            'attr_text'=>'Study Completion Status',
            'description'=>'Specification of study completion status, if no the reason should be specified',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'study_design',
            'attr_text'=>'Study Design',
            'description'=>'Epidemiological or omics reseach design context that this biosample was used in.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sub_species',
            'attr_text'=>'Sub Species',
            'description'=>'Sub species',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'subclone',
            'attr_text'=>'Subclone',
            'description'=>'Name for the derived clone or subculture from which the sample was taken.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'subgroup',
            'attr_text'=>'Subgroup',
            'description'=>'Taxonomy below subspecies; sometimes used in viruses to denote subgroups taken from a single isolate.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'subject_is_affected',
            'attr_text'=>'Subject Is Affected',
            'description'=>'Case vs control status for the subject of this sample, for case-control studies',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'subspecf_gen_lin',
            'attr_text'=>'Subspecf Genetic Lineage',
            'description'=>'Information about the genetic distinctness of the lineage (eg., biovar, serovar)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'subsrc_note',
            'attr_text'=>'Subsource Note',
            'description'=>'Subsource note',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'substrain',
            'attr_text'=>'Substrain',
            'description'=>'One level below strain.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'substrate',
            'attr_text'=>'Substrate',
            'description'=>'The growth substrate of the host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'substructure_type',
            'attr_text'=>'Substructure Type',
            'description'=>'Substructure or under building is that largely hidden section of the building which is built off the foundations to the ground floor level',
            'input_type_id'=>3,
            'list_value'=>', crawlspace, slab on grade, basement',
        ]);
        Attributesample::create([
            'attr_name'=>'subtype',
            'attr_text'=>'Subtype',
            'description'=>'Used as classifier in viruses (e.g. HIV type 1, Group M, Subtype A).',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sulfate',
            'attr_text'=>'Sulfate',
            'description'=>'Concentration of sulfate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'sulfide',
            'attr_text'=>'Sulfide',
            'description'=>'Concentration of sulfide',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'super_population_code',
            'attr_text'=>'Super Population Code',
            'description'=>'The 3 letter super population abbreviation from the Coriell Institute indicating ancestry',
            'input_type_id'=>3,
            'list_value'=>', AFR, AMR, EAS, EUR, SAS',
        ]);
        Attributesample::create([
            'attr_name'=>'super_population_description',
            'attr_text'=>'Super Population Description',
            'description'=>'The full, unabbreviated super population descriptor from the Coriell Institute',
            'input_type_id'=>3,
            'list_value'=>', African, Ad Mixed American, East Asian, European, South Asian',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_air_cont',
            'attr_text'=>'Surface Air Contaminant',
            'description'=>'Contaminant identified on surface',
            'input_type_id'=>3,
            'list_value'=>', dust, organic matter, particulate matter, volatile organic compounds, biological contaminants, radon, nutrients, biocides',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_humidity',
            'attr_text'=>'Surface Humidity',
            'description'=>'Surfaces: water activity as a function of air and material moisture',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_material',
            'attr_text'=>'Surface Material',
            'description'=>'Surface materials at the point of sampling',
            'input_type_id'=>3,
            'list_value'=>', concrete, wood, stone, tile, plastic, glass, vinyl, metal, carpet, stainless steel, paint, cinder blocks, hay bales, stucco, adobe',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_moisture',
            'attr_text'=>'Surface Moisture',
            'description'=>'Water held on a surface',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_moisture_ph',
            'attr_text'=>'Surface Moisture PH',
            'description'=>'PH measurement of surface',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'surf_temp',
            'attr_text'=>'Surface Temperature',
            'description'=>'Temperature of the surface at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'suspend_part_matter',
            'attr_text'=>'Suspend Particulate Matter',
            'description'=>'Concentration of suspended particulate matter',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'suspend_solids',
            'attr_text'=>'Suspend Solids',
            'description'=>'Concentration of substances including a wide variety of material, such as silt, decaying plant and animal matter, etc,; can include multiple substances',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'teleomorph',
            'attr_text'=>'Teleomorph',
            'description'=>'Genus and species of the sexual (fruiting) form of fungi - note that anamorph and teleomorph forms of the same taxon may have used taxonomic different names.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'temp',
            'attr_text'=>'Temperature',
            'description'=>'Temperature of the sample at time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tertiary_treatment',
            'attr_text'=>'Tertiary Treatment',
            'description'=>'The process providing a final treatment stage to raise the effluent quality before it is discharged to the receiving environment',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'texture',
            'attr_text'=>'Texture',
            'description'=>'The relative proportion of different grain sizes of mineral particles in a soil, as described using a standard system; express as % sand (50 um to 2 mm), silt (2 um to 50 um), and clay (<2 um) with textural name (e.g., silty clay loam) optional.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'texture_meth',
            'attr_text'=>'Texture Method',
            'description'=>'Reference or method used in determining soil texture',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tidal_stage',
            'attr_text'=>'Tidal Stage',
            'description'=>'Stage of tide',
            'input_type_id'=>3,
            'list_value'=>', low, high',
        ]);
        Attributesample::create([
            'attr_name'=>'tillage',
            'attr_text'=>'Tillage',
            'description'=>'Note method(s) used for tilling',
            'input_type_id'=>3,
            'list_value'=>', drill, cutting disc, ridge till, strip tillage, zonal tillage, chisel, tined, mouldboard, disc plough',
        ]);
        Attributesample::create([
            'attr_name'=>'time',
            'attr_text'=>'Time',
            'description'=>'Time',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'time_last_toothbrush',
            'attr_text'=>'Time Last Toothbrush',
            'description'=>'Specification of the time since last toothbrushing',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'time_since_last_wash',
            'attr_text'=>'Time Since Last Wash',
            'description'=>'Specification of the time since last wash',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tiss_cult_growth_med',
            'attr_text'=>'Tissue Culture Growth Media',
            'description'=>'Description of plant tissue culture growth media used',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tissue_lib',
            'attr_text'=>'Tissue Library',
            'description'=>'Formal identifier that points to source institute and tissue library identifier.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_carb',
            'attr_text'=>'Total Carbon',
            'description'=>'Total carbon content',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_depth_water_col',
            'attr_text'=>'Total Depth Water Column',
            'description'=>'Measurement of total depth of water column',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_diss_nitro',
            'attr_text'=>'Total Dissolved Nitrogen',
            'description'=>'Total dissolved nitrogen concentration, reported as nitrogen, measured by: total dissolved nitrogen = NH<span class="sub">4</span> + NO<span class="sub">3</span>NO<span class="sub">2</span> + dissolved organic nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_inorg_nitro',
            'attr_text'=>'Total Inorganic Nitrogen',
            'description'=>'Total inorganic nitrogen content',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_mass',
            'attr_text'=>'Total Mass',
            'description'=>'Total mass of the host at collection, the unit depends on host',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_n_meth',
            'attr_text'=>'Total N Method',
            'description'=>'Reference or method used in determining the total N',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_nitro',
            'attr_text'=>'Total Nitrogen',
            'description'=>'Total nitrogen concentration, calculated by: total nitrogen = total dissolved nitrogen + particulate nitrogen. Can also be measured without filtering, reported as nitrogen',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_org_c_meth',
            'attr_text'=>'Total Organic C Method',
            'description'=>'Reference or method used in determining total organic C',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_org_carb',
            'attr_text'=>'Total Organic Carbon',
            'description'=>'Definition for soil: total organic C content of the soil units of g C/kg soil. Definition otherwise: total organic carbon content',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_part_carb',
            'attr_text'=>'Total Particulate Carbon',
            'description'=>'Total particulate carbon content',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_phosp',
            'attr_text'=>'Total Phosphorus',
            'description'=>'Total phosphorus concentration, calculated by: total phosphorus = total dissolved phosphorus + particulate phosphorus. Can also be measured without filtering, reported as phosphorus',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'tot_phosphate',
            'attr_text'=>'Total Phosphate',
            'description'=>'Total amount or concentration of phosphate',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'travel_out_six_month',
            'attr_text'=>'Travel Out Six Month',
            'description'=>'Specification of the countries travelled in the last six months; can include multiple travels',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'treatment',
            'attr_text'=>'Treatment',
            'description'=>'Treatment, treatment protocol',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'trophic_level',
            'attr_text'=>'Trophic Level',
            'description'=>'Feeding position in food chain (eg., chemolithotroph)',
            'input_type_id'=>3,
            'list_value'=>', autotroph, carboxydotroph, chemoautotroph, chemoheterotroph, chemolithoautotroph, chemolithotroph, chemoorganoheterotroph, chemoorganotroph, chemosynthetic, chemotroph, copiotroph, diazotroph, facultative, heterotroph, lithoautotroph, lithoheterotroph, lithotroph, methanotroph, methylotroph, mixotroph, obligate, chemoautolithotroph, oligotroph, organoheterotroph, organotroph, photoautotroph, photoheterotroph, photolithoautotroph, photolithotroph, photosynthetic, phototroph',
        ]);
        Attributesample::create([
            'attr_name'=>'turbidity',
            'attr_text'=>'Turbidity',
            'description'=>'Turbidity measurement',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'twin_sibling',
            'attr_text'=>'Twin Sibling',
            'description'=>'Specification of twin sibling presence',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'type_status',
            'attr_text'=>'Type Status',
            'description'=>'Type status',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'type_strain',
            'attr_text'=>'Type Strain',
            'description'=>'Type strain',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'urine_collect_meth',
            'attr_text'=>'Urine Collect Method',
            'description'=>'Specification of urine collection method',
            'input_type_id'=>3,
            'list_value'=>', clean catch, catheter',
        ]);
        Attributesample::create([
            'attr_name'=>'urogenit_disord',
            'attr_text'=>'Urogenital Disorder',
            'description'=>'History of urogenital disorders, can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'urogenit_tract_disor',
            'attr_text'=>'Urogenital Tract Disorder',
            'description'=>'History of urogenitaltract disorders; can include multiple disorders',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'vaccine_received',
            'attr_text'=>'Vaccine Received',
            'description'=>'Which vaccine did the host receive, e.g., Pfizer-BioNTech COVID-19 vaccine',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'variety',
            'attr_text'=>'Variety',
            'description'=>'Variety',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ventilation_rate',
            'attr_text'=>'Ventilation Rate',
            'description'=>'Ventilation rate of the system in the sampled premises',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'virus_isolate_of_prior_infection',
            'attr_text'=>'Virus Isolate of Prior Infection',
            'description'=>'Specific isolate of SARS-CoV-2 in prior infection (if known), e.g., SARS-CoV-2/human/USA/CA-CDPH-001/2020',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'volatile_org_comp',
            'attr_text'=>'Volatile Organic Compounds',
            'description'=>'Concentration of carbon-based chemicals that easily evaporate at room temperature; can report multiple volatile organic compounds by entering numeric values preceded by name of compound',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'wastewater_type',
            'attr_text'=>'Wastewater Type',
            'description'=>'The origin of wastewater such as human waste, rainfall, storm drains, etc.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'water_content',
            'attr_text'=>'Water Content',
            'description'=>'Water content measurement',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'water_content_soil',
            'attr_text'=>'Water Content Soil',
            'description'=>'Water content (g/g or cm3/cm3)',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'water_content_soil_meth',
            'attr_text'=>'Water Content Soil Method',
            'description'=>'Reference or method used in determining the water content of soil',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'water_current',
            'attr_text'=>'Water Current',
            'description'=>'Measurement of magnitude and direction of flow within a fluid',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'water_temp_regm',
            'attr_text'=>'Water Temperature Regimen',
            'description'=>'Information about treatment involving an exposure to water with varying degree of temperature; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'watering_regm',
            'attr_text'=>'Watering Regimen',
            'description'=>'Information about treatment involving an exposure to watering frequencies; can include multiple regimens',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'weight_loss_3_month',
            'attr_text'=>'Weight Loss 3 Month',
            'description'=>'Specification of weight loss in the last three months, if yes should be further specified to include amount of weight loss',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'wet_mass',
            'attr_text'=>'Wet Mass',
            'description'=>'Measurement of wet mass',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'wind_direction',
            'attr_text'=>'Wind Direction',
            'description'=>'Wind direction is the direction from which a wind originates',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'wind_speed',
            'attr_text'=>'Wind Speed',
            'description'=>'Speed of wind measured at the time of sampling',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_1',
            'attr_text'=>'Wastewater Endogenous Control 1',
            'description'=>'The name of an organism, gene, or compound used as an endogenous wastewater control, e.g., pepper mild mottle virus',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_1_conc',
            'attr_text'=>'Wastewater Endogenous Control 1 Concentration',
            'description'=>'The concentration of the endogenous control specified in "ww_endog_control_1" on a per wastewater unit basis, e.g., 700000000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_1_protocol',
            'attr_text'=>'Wastewater Endogenous Control 1 Protocol',
            'description'=>'The protocol used to quantify "ww_endog_control_1". Specify a reference, website, or brief description.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_1_units',
            'attr_text'=>'Wastewater Endogenous Control 1 Units',
            'description'=>'The units of the value specified in "ww_endog_control_1_conc", e.g., copies/L wastewater',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_2',
            'attr_text'=>'Wastewater Endogenous Control 2',
            'description'=>'The name of an organism, gene, or compound used as an endogenous wastewater control, e.g., crassphage',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_2_conc',
            'attr_text'=>'Wastewater Endogenous Control 2 Concentration',
            'description'=>'The concentration of the endogenous control specified in "ww_endog_control_2" on a per wastewater unit basis, e.g., 140000000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_2_protocol',
            'attr_text'=>'Wastewater Endogenous Control 2 Protocol',
            'description'=>'The protocol used to quantify "ww_endog_control_2". Specify a reference, website, or brief description.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_endog_control_2_units',
            'attr_text'=>'Wastewater Endogenous Control 2 Units',
            'description'=>'The units of the value specified in "ww_endog_control_2_conc", e.g., copies/L wastewater',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_flow',
            'attr_text'=>'Wastewater Flow',
            'description'=>'Daily volumetric flow through collection site, in units of liters per day, e.g., 110000000.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_industrial_effluent_percent',
            'attr_text'=>'Wastewater Industrial Effluent Percentage',
            'description'=>'Percentage of industrial effluents received by wastewater treatment plant, e.g., 10',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_ph',
            'attr_text'=>'Wastewater PH',
            'description'=>'PH measurement of the sample, or liquid portion of sample, or aqueous phase of the fluid, e.g., 7.2',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_population_source',
            'attr_text'=>'Wastewater Population Source',
            'description'=>'Source of value specified in "ww_population", e.g., wastewater utility billing records, population of jurisdiction encompassing the wastewater service area, census blocks clipped to wastewater service area polygon',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_pre_treatment',
            'attr_text'=>'Wastewater Pre Treatment',
            'description'=>'Describe any process of pre-treatment that removes materials that can be easily collected from the raw wastewater, e.g., flow equilibration basin promotes settling of some solids',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_primary_sludge_retention_time',
            'attr_text'=>'Wastewater Primary Sludge Retention Time',
            'description'=>'The time primary sludge remains in tank, in hours, e.g., 4.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_processing_protocol',
            'attr_text'=>'Wastewater Processing Protocol',
            'description'=>'The protocol used to process the wastewater sample. Processing includes laboratory procedures prior to and including nucleic acid purification (e.g., pasteurization, concentration, extraction, etc). Specify a reference, website, or brief description.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_sample_salinity',
            'attr_text'=>'Wastewater Sample Salinity',
            'description'=>'Salinity is the total concentration of all dissolved salts in a liquid or solid (in the form of an extract obtained by centrifugation) sample or derived from the conductivity measurement (practical salinity) in milligrams per liter, e.g., 100.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_sample_site',
            'attr_text'=>'Wastewater Sample Site',
            'description'=>'The type of site where the wastewater sample was collected',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_jurisdiction',
            'attr_text'=>'Wastewater Surv Jurisdiction',
            'description'=>'A jurisdiction identifer that can be used to support linking the sample to a public health surveillance system, e.g., va',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_system_sample_id',
            'attr_text'=>'Wastewater Surveillance System Sample Id',
            'description'=>'The sample ID used for submission to a public health surveillance system (e.g., CDC\'s National Wastewater Surveillance System), e.g., s123456',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_conc',
            'attr_text'=>'Wastewater Surveillance Target 1 Conc',
            'description'=>'The concentration of the wastewater surveillance target specified in "ww_surv_target_1" on a per wastewater unit basis, e.g., 200000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_conc_unit',
            'attr_text'=>'Wastewater Surveillance Target 1 Conc Unit',
            'description'=>'The units of the value specified in "ww_surv_target_1_conc", e.g., copies/L wastewater',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_extract',
            'attr_text'=>'Wastewater Surveillance Target 1 Extract',
            'description'=>'Measured amount of surveillance target in the nucleic acid extract that was sequenced; on a per extract unit basis, rather than on a per wastewater sample unit basis, e.g., 100000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_extract_unit',
            'attr_text'=>'Wastewater Surveillance Target 1 Extract Unit',
            'description'=>'The units of the value specified in "ww_surv_target_1_extract", e.g., copies/microliter extract',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_gene',
            'attr_text'=>'Wastewater Surveillance Target 1 Gene',
            'description'=>'The name of the gene quantified for the surveillance target specified in "ww_surv_target_1", e.g., N gene',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_1_protocol',
            'attr_text'=>'Wastewater Surveillance Target 1 Protocol',
            'description'=>'The protocol used to quantify "ww_surv_target_1". Specify a reference, website, or brief description.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2',
            'attr_text'=>'Wastewater Surveillance Target 2',
            'description'=>'Taxonomic name of the surveillance target, eg, Norovirus',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_conc',
            'attr_text'=>'Wastewater Surveillance Target 2 Concentration',
            'description'=>'The concentration of the wastewater surveillance target specified in "ww_surv_target_2" on a per wastewater unit basis, e.g., 24000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_conc_unit',
            'attr_text'=>'Wastewater Surveillance Target 2 Conc Unit',
            'description'=>'The units of the value specified in "ww_surv_target_2_conc", e.g., copies/L wastewater',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_extract',
            'attr_text'=>'Wastewater Surveillance Target 2 Extract',
            'description'=>'Measured amount of surveillance target in the nucleic acid extract that was sequenced; on a per extract unit basis, rather than on a per wastewater sample unit basis, e.g., 12000',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_extract_unit',
            'attr_text'=>'Wastewater Surveillance Target 2 Extract Unit',
            'description'=>'The units of the value specified in "ww_surv_target_2_extract", e.g., copies/microliter extract',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_gene',
            'attr_text'=>'Wastewater Surveillance Target 2 Gene',
            'description'=>'The name of the gene quantified for the the surveillance target specified in "ww_surv_target_2", e.g., ORF1-ORF2 junction',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_known_present',
            'attr_text'=>'Wastewater Surveillance Target 2 Known Present',
            'description'=>'Is genetic material of the surveillance target(s) known to the submitter to be present in this wastewater sample? Presence defined as microbiological evidence of the target organism in the wastewater sample, such as genetic- or culture-based detection.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_surv_target_2_protocol',
            'attr_text'=>'Wastewater Surveillance Target 2 Protocol',
            'description'=>'The protocol used to quantify "ww_surv_target_2". Specify a reference, website, or brief description.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_temperature',
            'attr_text'=>'Wastewater Temperature',
            'description'=>'Temperature of the wastewater sample at the time of sampling in Celsius, e.g., 25.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        Attributesample::create([
            'attr_name'=>'ww_total_suspended_solids',
            'attr_text'=>'Wastewater Total Suspended Solids',
            'description'=>'Total concentration of solids in raw wastewater influent sample including a wide variety of material, such as silt, decaying plant and animal matter in milligrams per liter, e.g., 500.',
            'input_type_id'=>1,
            'list_value'=>'',
        ]);
        


    }
}
