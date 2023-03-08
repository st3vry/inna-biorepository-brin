<?php

namespace App\Http\Livewire;

use App\Models\Biosample;
use App\Models\User;
use App\Models\Sampletype;
use App\Models\SampletypePackage;
use App\Models\Attributesample;
use App\Models\Organism;
use App\Models\BioSampleExternalLink;
use App\Models\Sex;
use App\Models\Tissue;
use App\Models\Disease;
use App\Models\AttributeValue;
use Livewire\Component;

class CreateBiosample extends Component
{
    public $currentStep = 1;
    public $successMsg = '';

    public $submitter_name;
    public $submitter_email;
    public $submitter_lab;
    public $submitter_center;

    public $hold_release;
    public $biosample_links = [];
    public $comments;

    public $packages = [];
    public $package_id;
    public $sampletypes = [];
    public $sampletype_id;
    public $sample_find;
    public $sampletype_attributes = [];
    public $attributes = [];
    public $attribute_id;
    public $all_attributes = [];
    public $attribute_M = [];
    public $attribute_E = [];
    public $attribute_O = []; 
    public $attributes_M = [];
    public $attributes_E = []; 
    public $attributes_O = [];
    // -- variables for attributes --
    
    public $sample_name;
    public $sample_title;
    public $description;
    public $organism;
    public $taxonomy_id;
    public $bioproject_id;
    public $locus_tag_prefix;
    public $strain;
    public $isolate;
    public $breed;
    public $cultivar;
    public $ecotype;
    public $isolation_source;
    public $host;
    public $lab_host;
    public $age;
    public $dev_stage;
    public $tissue;
    public $sex;
    public $biomaterial_provider;
    public $sample_type;
    public $collection_date;
    public $geo_loc_name;
    public $lat_lon;
    public $env_broad_scale;
    public $env_local_scale;
    public $env_medium;
    public $depth;
    public $elev;
    public $altitude;
    public $isol_growth_condt;
    public $propagation;
    public $ref_biomaterial;
    public $num_replicons;
    public $collected_by;
    public $host_disease;
    public $metagenome_source;
    public $derived_from;
    public $abs_air_humidity;
    public $air_temp;
    public $build_occup_type;
    public $building_setting;
    public $carb_dioxide;
    public $filter_type;
    public $heat_cool_type;
    public $indoor_space;
    public $light_type;
    public $occup_samp;
    public $occupant_dens_samp;
    public $organism_count;
    public $rel_air_humidity;
    public $space_typ_state;
    public $typ_occupant_dens;
    public $ventilation_type;
    public $source_uvig;
    public $virus_enrich_appr;
    public $beta_lactamase_family;
    public $carbapenemase;
    public $edta_inhibitor_tested;
    public $ww_population;
    public $ww_sample_duration;
    public $ww_sample_matrix;
    public $ww_sample_type;
    public $ww_surv_target_1;
    public $ww_surv_target_1_known_present;
    public $biological_replicate;
    public $antibody;
    public $affection_status;
    public $agrochem_addition;
    public $air_temp_regm;
    public $al_sat;
    public $al_sat_meth;
    public $alkalinity;
    public $alkyl_diethers;
    public $aminopept_act;
    public $ammonium;
    public $amniotic_fluid_color;
    public $analyte_type;
    public $anamorph;
    public $annual_season_precpt;
    public $annual_season_temp;
    public $antibiotic_regm;
    public $antiviral_treatment_agent;
    public $atmospheric_data;
    public $authority;
    public $bac_prod;
    public $bac_resp;
    public $bacteria_carb_prod;
    public $barometric_press;
    public $bio_material;
    public $biochem_oxygen_dem;
    public $biomass;
    public $biotic_relationship;
    public $biovar;
    public $birth_control;
    public $birth_date;
    public $birth_location;
    public $bishomohopanol;
    public $blood_blood_disord;
    public $blood_press_diast;
    public $blood_press_syst;
    public $body_habitat;
    public $body_mass_index;
    public $body_product;
    public $breeding_history;
    public $breeding_method;
    public $bromide;
    public $calcium;
    public $carb_monoxide;
    public $carb_nitro_ratio;
    public $cell_line;
    public $cell_subtype;
    public $cell_type;
    public $chem_administration;
    public $chem_mutagen;
    public $chem_oxygen_dem;
    public $child_of;
    public $chloride;
    public $chlorophyll;
    public $climate_environment;
    public $clone;
    public $clone_lib;
    public $collection_device;
    public $collection_method;
    public $component_organism;
    public $conduc;
    public $crop_rotation;
    public $culture_collection;
    public $cur_land_use;
    public $cur_vegetation;
    public $cur_vegetation_meth;
    public $date_of_prior_antiviral_treat;
    public $date_of_prior_sars_cov_2_infection;
    public $date_of_sars_cov_2_vaccination;
    public $death_date;
    public $density;
    public $dermatology_disord;
    public $dew_point;
    public $diet_last_six_month;
    public $diether_lipids;
    public $disease;
    public $disease_stage;
    public $diss_carb_dioxide;
    public $diss_hydrogen;
    public $diss_inorg_carb;
    public $diss_inorg_nitro;
    public $diss_inorg_phosp;
    public $diss_org_carb;
    public $diss_org_nitro;
    public $diss_oxygen;
    public $dominant_hand;
    public $douche;
    public $down_par;
    public $drainage_class;
    public $drug_usage;
    public $dry_mass;
    public $efficiency_percent;
    public $emulsions;
    public $encoded_traits;
    public $env_package;
    public $estimated_size;
    public $ethnicity;
    public $experimental_factor;
    public $exposure_event;
    public $extrachrom_elements;
    public $extreme_event;
    public $extreme_salinity;
    public $family_id;
    public $family_relationship;
    public $fao_class;
    public $fertilizer_regm;
    public $fire;
    public $flooding;
    public $fluor;
    public $foetal_health_stat;
    public $forma;
    public $forma_specialis;
    public $fungicide_regm;
    public $gaseous_environment;
    public $gaseous_substances;
    public $gastrointest_disord;
    public $genetic_modification;
    public $genotype;
    public $geo_loc_exposure;
    public $gestation_state;
    public $gisaid_accession;
    public $gisaid_virus_name;
    public $glucosidase_act;
    public $gravidity;
    public $gravity;
    public $growth_hormone_regm;
    public $growth_med;
    public $growth_protocol;
    public $gynecologic_disord;
    public $haplotype;
    public $health_state;
    public $heavy_metals;
    public $heavy_metals_meth;
    public $height_or_length;
    public $herbicide_regm;
    public $histological_type;
    public $hiv_stat;
    public $horizon;
    public $horizon_meth;
    public $host_age;
    public $host_anatomical_material;
    public $host_anatomical_part;
    public $host_blood_press_diast;
    public $host_blood_press_syst;
    public $host_body_habitat;
    public $host_body_mass_index;
    public $host_body_product;
    public $host_body_temp;
    public $host_color;
    public $host_description;
    public $host_diet;
    public $host_disease_outcome;
    public $host_disease_stage;
    public $host_dry_mass;
    public $host_family_relationship;
    public $host_genotype;
    public $host_growth_cond;
    public $host_health_state;
    public $host_height;
    public $host_hiv_stat;
    public $host_infra_specific_name;
    public $host_infra_specific_rank;
    public $host_last_meal;
    public $host_length;
    public $host_life_stage;
    public $host_occupation;
    public $host_phenotype;
    public $host_pulse;
    public $host_recent_travel_loc;
    public $host_recent_travel_return_date;
    public $host_sex;
    public $host_shape;
    public $host_specimen_voucher;
    public $host_subject_id;
    public $host_substrate;
    public $host_taxid;
    public $host_tissue_sampled;
    public $host_tot_mass;
    public $host_wet_mass;
    public $hrt;
    public $humidity;
    public $humidity_regm;
    public $hysterectomy;
    public $identified_by;
    public $ihmc_medication_code;
    public $indoor_surf;
    public $indust_eff_percent;
    public $infection;
    public $infra_specific_name;
    public $infra_specific_rank;
    public $inorg_particles;
    public $investigation_type;
    public $is_tumor;
    public $isolate_name_alias;
    public $karyotype;
    public $kidney_disord;
    public $label;
    public $last_meal;
    public $life_stage;
    public $light_intensity;
    public $link_addit_analys;
    public $link_class_info;
    public $link_climate_info;
    public $liver_disord;
    public $local_class;
    public $local_class_meth;
    public $magnesium;
    public $maternal_health_stat;
    public $mating_type;
    public $mean_frict_vel;
    public $mean_peak_frict_vel;
    public $mechanical_damage;
    public $medic_hist_perform;
    public $menarche;
    public $menopause;
    public $methane;
    public $microbial_biomass;
    public $microbial_biomass_meth;
    public $mineral_nutr_regm;
    public $misc_param;
    public $molecular_data_type;
    public $morphology;
    public $n_alkanes;
    public $narms_isolate_number;
    public $nitrate;
    public $nitrite;
    public $nitro;
    public $non_mineral_nutr_regm;
    public $nose_mouth_teeth_throat_disord;
    public $nose_throat_disord;
    public $occupation;
    public $omics_observ_id;
    public $org_carb;
    public $org_matter;
    public $org_nitro;
    public $org_particles;
    public $orgmod_note;
    public $outbreak;
    public $oxy_stat_samp;
    public $oxygen;
    public $part_org_carb;
    public $part_org_nitro;
    public $particle_class;
    public $passage_history;
    public $passage_method;
    public $passage_number;
    public $pathogenicity;
    public $pathotype;
    public $pathovar;
    public $perturbation;
    public $pesticide_regm;
    public $pet_farm_animal;
    public $petroleum_hydrocarb;
    public $ph;
    public $ph_meth;
    public $ph_regm;
    public $phaeopigments;
    public $phenotype;
    public $phosphate;
    public $phosplipid_fatt_acid;
    public $photon_flux;
    public $plant_body_site;
    public $plant_product;
    public $ploidy;
    public $pollutants;
    public $pool_dna_extracts;
    public $population;
    public $population_description;
    public $porosity;
    public $potassium;
    public $pre_treatment;
    public $pregnancy;
    public $pressure;
    public $previous_land_use;
    public $previous_land_use_meth;
    public $primary_prod;
    public $primary_treatment;
    public $prior_sars_cov_2_antiviral_treat;
    public $prior_sars_cov_2_infection;
    public $prior_sars_cov_2_vaccination;
    public $profile_position;
    public $project_name;
    public $pulmonary_disord;
    public $pulse;
    public $purpose_of_sampling;
    public $purpose_of_sequencing;
    public $purpose_of_ww_sampling;
    public $purpose_of_ww_sequencing;
    public $race;
    public $radiation_regm;
    public $rainfall_regm;
    public $reactor_type;
    public $redox_potential;
    public $reference_material;
    public $rel_to_oxygen;
    public $repository;
    public $resp_part_matter;
    public $risk_group;
    public $salinity;
    public $salinity_meth;
    public $salt_regm;
    public $same_as;
    public $samp_collect_device;
    public $samp_mat_process;
    public $samp_salinity;
    public $samp_size;
    public $samp_sort_meth;
    public $samp_store_dur;
    public $samp_store_loc;
    public $samp_store_temp;
    public $samp_vol_we_dna_ext;
    public $sars_cov_2_diag_gene_name_1;
    public $sars_cov_2_diag_gene_name_2;
    public $sars_cov_2_diag_pcr_ct_value_1;
    public $sars_cov_2_diag_pcr_ct_value_2;
    public $season_environment;
    public $secondary_treatment;
    public $sediment_type;
    public $sequenced_by;
    public $serogroup;
    public $serotype;
    public $serovar;
    public $sewage_type;
    public $sexual_act;
    public $sieving;
    public $silicate;
    public $size_frac;
    public $slope_aspect;
    public $slope_gradient;
    public $sludge_retent_time;
    public $smoker;
    public $sodium;
    public $soil_type;
    public $soil_type_meth;
    public $solar_irradiance;
    public $soluble_inorg_mat;
    public $soluble_org_mat;
    public $soluble_react_phosp;
    public $source_material_id;
    public $source_name;
    public $special_diet;
    public $specimen_voucher;
    public $standing_water_regm;
    public $store_cond;
    public $stress;
    public $stud_book_number;
    public $study_complt_stat;
    public $study_design;
    public $sub_species;
    public $subclone;
    public $subgroup;
    public $subject_is_affected;
    public $subspecf_gen_lin;
    public $subsrc_note;
    public $substrain;
    public $substrate;
    public $substructure_type;
    public $subtype;
    public $sulfate;
    public $sulfide;
    public $super_population_code;
    public $super_population_description;
    public $surf_air_cont;
    public $surf_humidity;
    public $surf_material;
    public $surf_moisture;
    public $surf_moisture_ph;
    public $surf_temp;
    public $suspend_part_matter;
    public $suspend_solids;
    public $teleomorph;
    public $temp;
    public $tertiary_treatment;
    public $texture;
    public $texture_meth;
    public $tidal_stage;
    public $tillage;
    public $time;
    public $time_last_toothbrush;
    public $time_since_last_wash;
    public $tiss_cult_growth_med;
    public $tissue_lib;
    public $tot_carb;
    public $tot_depth_water_col;
    public $tot_diss_nitro;
    public $tot_inorg_nitro;
    public $tot_mass;
    public $tot_n_meth;
    public $tot_nitro;
    public $tot_org_c_meth;
    public $tot_org_carb;
    public $tot_part_carb;
    public $tot_phosp;
    public $tot_phosphate;
    public $travel_out_six_month;
    public $treatment;
    public $trophic_level;
    public $turbidity;
    public $twin_sibling;
    public $type_status;
    public $type_strain;
    public $urine_collect_meth;
    public $urogenit_disord;
    public $urogenit_tract_disor;
    public $vaccine_received;
    public $variety;
    public $ventilation_rate;
    public $virus_isolate_of_prior_infection;
    public $volatile_org_comp;
    public $wastewater_type;
    public $water_content;
    public $water_content_soil;
    public $water_content_soil_meth;
    public $water_current;
    public $water_temp_regm;
    public $watering_regm;
    public $weight_loss_3_month;
    public $wet_mass;
    public $wind_direction;
    public $wind_speed;
    public $ww_endog_control_1;
    public $ww_endog_control_1_conc;
    public $ww_endog_control_1_protocol;
    public $ww_endog_control_1_units;
    public $ww_endog_control_2;
    public $ww_endog_control_2_conc;
    public $ww_endog_control_2_protocol;
    public $ww_endog_control_2_units;
    public $ww_flow;
    public $ww_industrial_effluent_percent;
    public $ww_ph;
    public $ww_population_source;
    public $ww_pre_treatment;
    public $ww_primary_sludge_retention_time;
    public $ww_processing_protocol;
    public $ww_sample_salinity;
    public $ww_sample_site;
    public $ww_surv_jurisdiction;
    public $ww_surv_system_sample_id;
    public $ww_surv_target_1_conc;
    public $ww_surv_target_1_conc_unit;
    public $ww_surv_target_1_extract;
    public $ww_surv_target_1_extract_unit;
    public $ww_surv_target_1_gene;
    public $ww_surv_target_1_protocol;
    public $ww_surv_target_2;
    public $ww_surv_target_2_conc;
    public $ww_surv_target_2_conc_unit;
    public $ww_surv_target_2_extract;
    public $ww_surv_target_2_extract_unit;
    public $ww_surv_target_2_gene;
    public $ww_surv_target_2_known_present;
    public $ww_surv_target_2_protocol;
    public $ww_temperature;
    public $ww_total_suspended_solids;
    
    //Attribute Select from DB
    public $organism_id;
    public $organism_all;


    public $rules = [
        'sample_title' => 'required|min:6',
        'description' => 'required|min:6',
        //'organism' => 'required',
        'hold_release' => 'required',
        'sampletype_id' => 'required',
        'comments' => '',

        'biosample_links.*.link_description' => '',
        'biosample_links.*.link_url' => '',
        
        // Attributes
        /*
        'sample_name' => '',
        'taxonomy_id' => '',
        'bioproject_id' => '',
        'locus_tag_prefix' => '',
        'strain' => '',
        'isolate' => '',
        'breed' => '',
        'cultivar' => '',
        'ecotype' => '',
        'isolation_source' => '',
        'host' => '',
        'lab_host' => '',
        'age' => '',
        'dev_stage' => '',
        'tissue' => '',
        'sex' => '',
        'biomaterial_provider' => '',
        'sample_type' => '',
        'collection_date' => '',
        'geo_loc_name' => '',
        'lat_lon' => '',
        'env_broad_scale' => '',
        'env_local_scale' => '',
        'env_medium' => '',
        'depth' => '',
        'elev' => '',
        'altitude' => '',
        'isol_growth_condt' => '',
        'propagation' => '',
        'ref_biomaterial' => '',
        'num_replicons' => '',
        'collected_by' => '',
        'host_disease' => '',
        'metagenome_source' => '',
        'derived_from' => '',
        'abs_air_humidity' => '',
        'air_temp' => '',
        'build_occup_type' => '',
        'building_setting' => '',
        'carb_dioxide' => '',
        'filter_type' => '',
        'heat_cool_type' => '',
        'indoor_space' => '',
        'light_type' => '',
        'occup_samp' => '',
        'occupant_dens_samp' => '',
        'organism_count' => '',
        'rel_air_humidity' => '',
        'space_typ_state' => '',
        'typ_occupant_dens' => '',
        'ventilation_type' => '',
        'source_uvig' => '',
        'virus_enrich_appr' => '',
        'beta_lactamase_family' => '',
        'carbapenemase' => '',
        'edta_inhibitor_tested' => '',
        'ww_population' => '',
        'ww_sample_duration' => '',
        'ww_sample_matrix' => '',
        'ww_sample_type' => '',
        'ww_surv_target_1' => '',
        'ww_surv_target_1_known_present' => '',
        'biological_replicate' => '',
        'antibody' => '',
        'affection_status' => '',
        'agrochem_addition' => '',
        'air_temp_regm' => '',
        'al_sat' => '',
        'al_sat_meth' => '',
        'alkalinity' => '',
        'alkyl_diethers' => '',
        'aminopept_act' => '',
        'ammonium' => '',
        'amniotic_fluid_color' => '',
        'analyte_type' => '',
        'anamorph' => '',
        'annual_season_precpt' => '',
        'annual_season_temp' => '',
        'antibiotic_regm' => '',
        'antiviral_treatment_agent' => '',
        'atmospheric_data' => '',
        'authority' => '',
        'bac_prod' => '',
        'bac_resp' => '',
        'bacteria_carb_prod' => '',
        'barometric_press' => '',
        'bio_material' => '',
        'biochem_oxygen_dem' => '',
        'biomass' => '',
        'biotic_relationship' => '',
        'biovar' => '',
        'birth_control' => '',
        'birth_date' => '',
        'birth_location' => '',
        'bishomohopanol' => '',
        'blood_blood_disord' => '',
        'blood_press_diast' => '',
        'blood_press_syst' => '',
        'body_habitat' => '',
        'body_mass_index' => '',
        'body_product' => '',
        'breeding_history' => '',
        'breeding_method' => '',
        'bromide' => '',
        'calcium' => '',
        'carb_monoxide' => '',
        'carb_nitro_ratio' => '',
        'cell_line' => '',
        'cell_subtype' => '',
        'cell_type' => '',
        'chem_administration' => '',
        'chem_mutagen' => '',
        'chem_oxygen_dem' => '',
        'child_of' => '',
        'chloride' => '',
        'chlorophyll' => '',
        'climate_environment' => '',
        'clone' => '',
        'clone_lib' => '',
        'collection_device' => '',
        'collection_method' => '',
        'component_organism' => '',
        'conduc' => '',
        'crop_rotation' => '',
        'culture_collection' => '',
        'cur_land_use' => '',
        'cur_vegetation' => '',
        'cur_vegetation_meth' => '',
        'date_of_prior_antiviral_treat' => '',
        'date_of_prior_sars_cov_2_infection' => '',
        'date_of_sars_cov_2_vaccination' => '',
        'death_date' => '',
        'density' => '',
        'dermatology_disord' => '',
        'dew_point' => '',
        'diet_last_six_month' => '',
        'diether_lipids' => '',
        'disease' => '',
        'disease_stage' => '',
        'diss_carb_dioxide' => '',
        'diss_hydrogen' => '',
        'diss_inorg_carb' => '',
        'diss_inorg_nitro' => '',
        'diss_inorg_phosp' => '',
        'diss_org_carb' => '',
        'diss_org_nitro' => '',
        'diss_oxygen' => '',
        'dominant_hand' => '',
        'douche' => '',
        'down_par' => '',
        'drainage_class' => '',
        'drug_usage' => '',
        'dry_mass' => '',
        'efficiency_percent' => '',
        'emulsions' => '',
        'encoded_traits' => '',
        'env_package' => '',
        'estimated_size' => '',
        'ethnicity' => '',
        'experimental_factor' => '',
        'exposure_event' => '',
        'extrachrom_elements' => '',
        'extreme_event' => '',
        'extreme_salinity' => '',
        'family_id' => '',
        'family_relationship' => '',
        'fao_class' => '',
        'fertilizer_regm' => '',
        'fire' => '',
        'flooding' => '',
        'fluor' => '',
        'foetal_health_stat' => '',
        'forma' => '',
        'forma_specialis' => '',
        'fungicide_regm' => '',
        'gaseous_environment' => '',
        'gaseous_substances' => '',
        'gastrointest_disord' => '',
        'genetic_modification' => '',
        'genotype' => '',
        'geo_loc_exposure' => '',
        'gestation_state' => '',
        'gisaid_accession' => '',
        'gisaid_virus_name' => '',
        'glucosidase_act' => '',
        'gravidity' => '',
        'gravity' => '',
        'growth_hormone_regm' => '',
        'growth_med' => '',
        'growth_protocol' => '',
        'gynecologic_disord' => '',
        'haplotype' => '',
        'health_state' => '',
        'heavy_metals' => '',
        'heavy_metals_meth' => '',
        'height_or_length' => '',
        'herbicide_regm' => '',
        'histological_type' => '',
        'hiv_stat' => '',
        'horizon' => '',
        'horizon_meth' => '',
        'host_age' => '',
        'host_anatomical_material' => '',
        'host_anatomical_part' => '',
        'host_blood_press_diast' => '',
        'host_blood_press_syst' => '',
        'host_body_habitat' => '',
        'host_body_mass_index' => '',
        'host_body_product' => '',
        'host_body_temp' => '',
        'host_color' => '',
        'host_description' => '',
        'host_diet' => '',
        'host_disease_outcome' => '',
        'host_disease_stage' => '',
        'host_dry_mass' => '',
        'host_family_relationship' => '',
        'host_genotype' => '',
        'host_growth_cond' => '',
        'host_health_state' => '',
        'host_height' => '',
        'host_hiv_stat' => '',
        'host_infra_specific_name' => '',
        'host_infra_specific_rank' => '',
        'host_last_meal' => '',
        'host_length' => '',
        'host_life_stage' => '',
        'host_occupation' => '',
        'host_phenotype' => '',
        'host_pulse' => '',
        'host_recent_travel_loc' => '',
        'host_recent_travel_return_date' => '',
        'host_sex' => '',
        'host_shape' => '',
        'host_specimen_voucher' => '',
        'host_subject_id' => '',
        'host_substrate' => '',
        'host_taxid' => '',
        'host_tissue_sampled' => '',
        'host_tot_mass' => '',
        'host_wet_mass' => '',
        'hrt' => '',
        'humidity' => '',
        'humidity_regm' => '',
        'hysterectomy' => '',
        'identified_by' => '',
        'ihmc_medication_code' => '',
        'indoor_surf' => '',
        'indust_eff_percent' => '',
        'infection' => '',
        'infra_specific_name' => '',
        'infra_specific_rank' => '',
        'inorg_particles' => '',
        'investigation_type' => '',
        'is_tumor' => '',
        'isolate_name_alias' => '',
        'karyotype' => '',
        'kidney_disord' => '',
        'label' => '',
        'last_meal' => '',
        'life_stage' => '',
        'light_intensity' => '',
        'link_addit_analys' => '',
        'link_class_info' => '',
        'link_climate_info' => '',
        'liver_disord' => '',
        'local_class' => '',
        'local_class_meth' => '',
        'magnesium' => '',
        'maternal_health_stat' => '',
        'mating_type' => '',
        'mean_frict_vel' => '',
        'mean_peak_frict_vel' => '',
        'mechanical_damage' => '',
        'medic_hist_perform' => '',
        'menarche' => '',
        'menopause' => '',
        'methane' => '',
        'microbial_biomass' => '',
        'microbial_biomass_meth' => '',
        'mineral_nutr_regm' => '',
        'misc_param' => '',
        'molecular_data_type' => '',
        'morphology' => '',
        'n_alkanes' => '',
        'narms_isolate_number' => '',
        'nitrate' => '',
        'nitrite' => '',
        'nitro' => '',
        'non_mineral_nutr_regm' => '',
        'nose_mouth_teeth_throat_disord' => '',
        'nose_throat_disord' => '',
        'occupation' => '',
        'omics_observ_id' => '',
        'org_carb' => '',
        'org_matter' => '',
        'org_nitro' => '',
        'org_particles' => '',
        'orgmod_note' => '',
        'outbreak' => '',
        'oxy_stat_samp' => '',
        'oxygen' => '',
        'part_org_carb' => '',
        'part_org_nitro' => '',
        'particle_class' => '',
        'passage_history' => '',
        'passage_method' => '',
        'passage_number' => '',
        'pathogenicity' => '',
        'pathotype' => '',
        'pathovar' => '',
        'perturbation' => '',
        'pesticide_regm' => '',
        'pet_farm_animal' => '',
        'petroleum_hydrocarb' => '',
        'ph' => '',
        'ph_meth' => '',
        'ph_regm' => '',
        'phaeopigments' => '',
        'phenotype' => '',
        'phosphate' => '',
        'phosplipid_fatt_acid' => '',
        'photon_flux' => '',
        'plant_body_site' => '',
        'plant_product' => '',
        'ploidy' => '',
        'pollutants' => '',
        'pool_dna_extracts' => '',
        'population' => '',
        'population_description' => '',
        'porosity' => '',
        'potassium' => '',
        'pre_treatment' => '',
        'pregnancy' => '',
        'pressure' => '',
        'previous_land_use' => '',
        'previous_land_use_meth' => '',
        'primary_prod' => '',
        'primary_treatment' => '',
        'prior_sars_cov_2_antiviral_treat' => '',
        'prior_sars_cov_2_infection' => '',
        'prior_sars_cov_2_vaccination' => '',
        'profile_position' => '',
        'project_name' => '',
        'pulmonary_disord' => '',
        'pulse' => '',
        'purpose_of_sampling' => '',
        'purpose_of_sequencing' => '',
        'purpose_of_ww_sampling' => '',
        'purpose_of_ww_sequencing' => '',
        'race' => '',
        'radiation_regm' => '',
        'rainfall_regm' => '',
        'reactor_type' => '',
        'redox_potential' => '',
        'reference_material' => '',
        'rel_to_oxygen' => '',
        'repository' => '',
        'resp_part_matter' => '',
        'risk_group' => '',
        'salinity' => '',
        'salinity_meth' => '',
        'salt_regm' => '',
        'same_as' => '',
        'samp_collect_device' => '',
        'samp_mat_process' => '',
        'samp_salinity' => '',
        'samp_size' => '',
        'samp_sort_meth' => '',
        'samp_store_dur' => '',
        'samp_store_loc' => '',
        'samp_store_temp' => '',
        'samp_vol_we_dna_ext' => '',
        'sars_cov_2_diag_gene_name_1' => '',
        'sars_cov_2_diag_gene_name_2' => '',
        'sars_cov_2_diag_pcr_ct_value_1' => '',
        'sars_cov_2_diag_pcr_ct_value_2' => '',
        'season_environment' => '',
        'secondary_treatment' => '',
        'sediment_type' => '',
        'sequenced_by' => '',
        'serogroup' => '',
        'serotype' => '',
        'serovar' => '',
        'sewage_type' => '',
        'sexual_act' => '',
        'sieving' => '',
        'silicate' => '',
        'size_frac' => '',
        'slope_aspect' => '',
        'slope_gradient' => '',
        'sludge_retent_time' => '',
        'smoker' => '',
        'sodium' => '',
        'soil_type' => '',
        'soil_type_meth' => '',
        'solar_irradiance' => '',
        'soluble_inorg_mat' => '',
        'soluble_org_mat' => '',
        'soluble_react_phosp' => '',
        'source_material_id' => '',
        'source_name' => '',
        'special_diet' => '',
        'specimen_voucher' => '',
        'standing_water_regm' => '',
        'store_cond' => '',
        'stress' => '',
        'stud_book_number' => '',
        'study_complt_stat' => '',
        'study_design' => '',
        'sub_species' => '',
        'subclone' => '',
        'subgroup' => '',
        'subject_is_affected' => '',
        'subspecf_gen_lin' => '',
        'subsrc_note' => '',
        'substrain' => '',
        'substrate' => '',
        'substructure_type' => '',
        'subtype' => '',
        'sulfate' => '',
        'sulfide' => '',
        'super_population_code' => '',
        'super_population_description' => '',
        'surf_air_cont' => '',
        'surf_humidity' => '',
        'surf_material' => '',
        'surf_moisture' => '',
        'surf_moisture_ph' => '',
        'surf_temp' => '',
        'suspend_part_matter' => '',
        'suspend_solids' => '',
        'teleomorph' => '',
        'temp' => '',
        'tertiary_treatment' => '',
        'texture' => '',
        'texture_meth' => '',
        'tidal_stage' => '',
        'tillage' => '',
        'time' => '',
        'time_last_toothbrush' => '',
        'time_since_last_wash' => '',
        'tiss_cult_growth_med' => '',
        'tissue_lib' => '',
        'tot_carb' => '',
        'tot_depth_water_col' => '',
        'tot_diss_nitro' => '',
        'tot_inorg_nitro' => '',
        'tot_mass' => '',
        'tot_n_meth' => '',
        'tot_nitro' => '',
        'tot_org_c_meth' => '',
        'tot_org_carb' => '',
        'tot_part_carb' => '',
        'tot_phosp' => '',
        'tot_phosphate' => '',
        'travel_out_six_month' => '',
        'treatment' => '',
        'trophic_level' => '',
        'turbidity' => '',
        'twin_sibling' => '',
        'type_status' => '',
        'type_strain' => '',
        'urine_collect_meth' => '',
        'urogenit_disord' => '',
        'urogenit_tract_disor' => '',
        'vaccine_received' => '',
        'variety' => '',
        'ventilation_rate' => '',
        'virus_isolate_of_prior_infection' => '',
        'volatile_org_comp' => '',
        'wastewater_type' => '',
        'water_content' => '',
        'water_content_soil' => '',
        'water_content_soil_meth' => '',
        'water_current' => '',
        'water_temp_regm' => '',
        'watering_regm' => '',
        'weight_loss_3_month' => '',
        'wet_mass' => '',
        'wind_direction' => '',
        'wind_speed' => '',
        'ww_endog_control_1' => '',
        'ww_endog_control_1_conc' => '',
        'ww_endog_control_1_protocol' => '',
        'ww_endog_control_1_units' => '',
        'ww_endog_control_2' => '',
        'ww_endog_control_2_conc' => '',
        'ww_endog_control_2_protocol' => '',
        'ww_endog_control_2_units' => '',
        'ww_flow' => '',
        'ww_industrial_effluent_percent' => '',
        'ww_ph' => '',
        'ww_population_source' => '',
        'ww_pre_treatment' => '',
        'ww_primary_sludge_retention_time' => '',
        'ww_processing_protocol' => '',
        'ww_sample_salinity' => '',
        'ww_sample_site' => '',
        'ww_surv_jurisdiction' => '',
        'ww_surv_system_sample_id' => '',
        'ww_surv_target_1_conc' => '',
        'ww_surv_target_1_conc_unit' => '',
        'ww_surv_target_1_extract' => '',
        'ww_surv_target_1_extract_unit' => '',
        'ww_surv_target_1_gene' => '',
        'ww_surv_target_1_protocol' => '',
        'ww_surv_target_2' => '',
        'ww_surv_target_2_conc' => '',
        'ww_surv_target_2_conc_unit' => '',
        'ww_surv_target_2_extract' => '',
        'ww_surv_target_2_extract_unit' => '',
        'ww_surv_target_2_gene' => '',
        'ww_surv_target_2_known_present' => '',
        'ww_surv_target_2_protocol' => '',
        'ww_temperature' => '',
        'ww_total_suspended_solids' => '',
        */
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
            'hold_release' => 'required',
            'biosample_links.*.link_description' => '',
            'biosample_links.*.link_url' => '',
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

        if($this->sample_find->attribute_M != ''){
            $this->attribute_M = explode(',', $this->sample_find->attribute_M);
            $this->attributes_M = Attributesample::whereIn('id', $this->attribute_M)->get();
            foreach($this->attributes_M as $attr_M){
                $this->rules[$attr_M->attr_name] = 'required';
                
            }
        }
        if($this->sample_find->attribute_E != ''){
            $this->attribute_E = explode(',', $this->sample_find->attribute_E);
            $this->attributes_E = Attributesample::whereIn('id', $this->attribute_E)->get();
            foreach($this->attributes_E as $attr_E){
                $this->rules[$attr_E->attr_name] = 'required';
            }
        }

        $this->attribute_O = array_diff($this->sampletype_attributes,  $this->attribute_M,  $this->attribute_E);
        $this->attributes_O = Attributesample::whereIn('id', $this->attribute_O)->get();
        foreach($this->attributes_O as $attr_O){
            $this->rules[$attr_O->attr_name] = '';
        }

        $this->currentStep = 4;
    }

    public function fourthStepSubmit()
    {
        
        $valData = [];
        foreach ($this->attributes_M as $attr_M){
            $valData[$attr_M->attr_name] = 'required';
            
            //$validatedData = $this->validate([
            //    $attr_M->attr_name => 'required',
            //]);
        } 
        $validatedData = $this->validate($valData);
        
        dd($validatedData);
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
        //    ['biosamplelink_id' => '', 'link_description' => '', 'link_url' => '']
        //];

        $this->packages = SampletypePackage::all();
        $this->sampletypes = Sampletype::all();

        //$this->organism_all = Organism::all();
        //$this->host = Organism::all();
        //$this->sex = Sex::all();
        //$this->host_sex = Sex::all();
        //$this->disease = Disease::all();
        //$this->host_disease = Disease::all();
        //$this->host_tissue_sampled = Tissue::all();
        //$this->all_attributes = Attributesample::all();

       
    }
    
    public function addLink()
    {
        $this->biosample_links[] = ['link_description' => '', 'link_url' => ''];
    }

    public function removeLink($index)
    {
        unset($this->biosample_links[$index]);
        $this->biosample_links = array_values($this->biosample_links);
    }

    public function resetSampletype()
    {
        $this->sampletype_id = NULL;
    }

    public function submitForm()
    {

        $validatedData = $this->validate();
        $biosample = new Biosample();
        $biosample->accession = 'SAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->submission_id = 'SUBSAM' . sprintf('%06d', intval($biosample->query()->max("id")) + 1);
        $biosample->title = $validatedData['sample_title'];
        $biosample->description = $validatedData['description'];
        $biosample->hold_release = $validatedData['hold_release'];
        $biosample->comments = $validatedData['comments'];
        $biosample->sampletype_id = $validatedData['sampletype_id'];

        $biosample->center_id = auth()->user()->lab->center_id;
        $biosample->user_id = auth()->user()->id;
        // need to change if organism table ready
        $biosample->organism_id = mt_rand(1, 4);
        $biosample->organism_name = $validatedData['organism'];
        //

        $biosample->save();

        if (count($validatedData['biosample_links']) > 0) {
            foreach ($validatedData['biosample_links'] as  $item => $value) {
                $data1 = array(
                    'biosample_id' => $biosample->id,
                    'link_description' => $validatedData['biosample_links'][$item]['link_description'],
                    'link_url' => $validatedData['biosample_links'][$item]['link_url'],
                );
                BioSampleExternalLink::create($data1);
            }
        }

        // Sample Attributes
        foreach ($this->attributes as $attr){
            $attribute_value = new AttributeValue();
            $attribute_value->biosample_id = $biosample->id;
            $attribute_value->sampletype_id = $validatedData['sampletype_id'];
            $attribute_value->attributesample_id = $attr->id;
            if ($attr->input_type_id == 7){
                if(!empty($validatedData[($attr->attr_name).'_id'])){
                    $attribute_value->value = $validatedData[($attr->attr_name).'_id'];
                    $attribute_value->save();
                }
            }else{
                if(!empty($validatedData[$attr->attr_name])){
                    $attribute_value->value = $validatedData[$attr->attr_name];
                    $attribute_value->save();
                }
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
