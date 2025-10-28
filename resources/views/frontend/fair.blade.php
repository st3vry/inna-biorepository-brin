@extends('layouts.main')
@section('container')
<div class="container mt-5">
    <h1 class="text-center mb-4">INNA Data Structure</h1>
    <div class="text-center mb-4">
        <!-- <img src="{{ asset('storage/INNA_Scenario-Case4.drawio.jpg') }}" alt="INNA Relationship Diagram" class="img-fluid rounded shadow" style="max-width: 800px;"> -->
        <img src="images/INNA_Scenario-Case4.drawio.jpg" alt="INNA Data Structure" class="img-fluid m-3" width="800px" data-aos="fade-left" data-aos-delay="200">

        <figcaption class="mt-3 text-muted" style="font-size: 0.96em;">
            Illustration: Relationship between BioProject, BioSample, BioArchive, and file layers in the Indonesian Nucleotide Archive (InNA).
        </figcaption>
    </div>

    <section class="mt-5">
        <h2>About FAIR Principles</h2>
        <p>
            The Indonesian Nucleotide Archive (InNA) implements <strong>FAIR</strong> principles (Findable, Accessible, Interoperable, and Reusable) in scientific data stewardship.<br>
            FAIR ensures data is:
        </p>
        <ul>
            <li><strong>Findable:</strong> Easily discoverable through robust metadata and unique identifiers.</li>
            <li><strong>Accessible:</strong> Openly available in line with relevant policies and regulations.</li>
            <li><strong>Interoperable:</strong> Usable across various platforms and systems using standard formats.</li>
            <li><strong>Reusable:</strong> Ready for future research and analysis, with clear provenance and licensing.</li>
        </ul>
        <p>
            Thanks to a well-defined hierarchical structure, as shown above, InNA empowers researchers to responsibly share and manage genomic data while adhering to global standards for open science.
        </p>
    </section>
</div>

@endsection