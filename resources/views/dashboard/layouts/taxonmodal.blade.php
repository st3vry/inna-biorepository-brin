<style>
/* ── Detail page layout ───────────────────────────────────── */
.taxon-detail-page { font-size: 0.875rem; }

.taxon-organism-name {
    font-size: 1.6rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 0.25rem;
}

.taxon-section-title {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #6c757d;
    margin-bottom: 0.75rem;
    margin-top: 1.25rem;
}

/* ── Name details table ───────────────────────────────────── */
.taxon-name-table { width: 100%; border-collapse: collapse; }
.taxon-name-table tr { border-bottom: 1px solid #f0f0f0; }
.taxon-name-table td { padding: 0.45rem 0.5rem 0.45rem 0; vertical-align: top; }
.taxon-name-table td:first-child {
    color: #6c757d;
    width: 210px;
    min-width: 160px;
    white-space: nowrap;
    padding-right: 1.5rem;
}
.taxon-name-table td:last-child { color: #212529; }

/* ── References ───────────────────────────────────────────── */
.taxon-references-title {
    font-weight: 700;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}
.taxon-references ul { padding-left: 1.25rem; margin: 0; }
.taxon-references li { margin-bottom: 0.5rem; }
.taxon-references .ref-short { font-weight: 700; }
.taxon-references .ref-full  { color: #495057; }

/* ── Disclaimer ───────────────────────────────────────────── */
.taxon-disclaimer {
    margin-top: 1.25rem;
    font-size: 0.78rem;
    color: #6c757d;
    border-top: 1px solid #dee2e6;
    padding-top: 0.75rem;
}

/* ── Lineage sidebar ──────────────────────────────────────── */
.taxon-lineage-panel {
    background: #f0f5ff;
    border-radius: 0.5rem;
    padding: 1rem 1.25rem;
    height: 100%;
}
.taxon-lineage-panel h6 {
    font-weight: 700;
    margin-bottom: 0.75rem;
    color: #212529;
}
.taxon-lineage-item { margin-bottom: 0.5rem; }
.taxon-lineage-item .lineage-name {
    display: block;
    color: #0d6efd;
    font-weight: 500;
}
.taxon-lineage-item .lineage-rank {
    display: block;
    font-size: 0.75rem;
    color: #6c757d;
    text-transform: capitalize;
}

/* ── Section header row inside table ──────────────────────── */
.taxon-section-header {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #6c757d;
    background: #f8f9fa;
    padding-top: 0.75rem !important;
    border-top: 2px solid #dee2e6;
}

/* ── Array item index row ─────────────────────────────────── */
.taxon-array-index {
    font-size: 0.72rem;
    color: #adb5bd;
    font-weight: 600;
    padding-top: 0.4rem !important;
    padding-bottom: 0.1rem !important;
}
</style>

    <!-- Taxon Search Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="taxonModalLabel" aria-hidden="true" id="taxonModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="taxonModalLabel">Search Organism (NCBI Taxonomy)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {{-- Search Bar --}}
                    <div class="input-group mb-3">
                        <input type="text" id="taxonSearchInput" class="form-control"
                            placeholder="Type organism name to search..." autocomplete="off">
                        <button class="btn btn-primary" type="button" id="taxonSearchBtn">
                            <i class="ri-search-line"></i> Search
                        </button>
                    </div>

                    {{-- Suggestions List --}}
                    <ul id="taxonSuggestions" class="list-group mb-3" style="display:none; max-height: 220px; overflow-y: auto;"></ul>

                    {{-- Loading Spinner --}}
                    <div id="taxonLoading" class="text-center py-3" style="display:none;">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    {{-- Error Message --}}
                    <div id="taxonError" class="alert alert-danger" style="display:none;"></div>

                    {{-- Detail Result --}}
                    <div id="taxonDetail" style="display:none;">
                        <hr>
                        <a href="#" id="taxonBackBtn" class="text-decoration-none d-inline-flex align-items-center gap-1 mb-3 small">
                            <i class="ri-arrow-left-line"></i> Back to results
                        </a>
                        <div id="taxonDetailBody"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="taxonSelectBtn" style="display:none;">
                        <i class="ri-check-line"></i> Select this Organism
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script>
(function () {
    let selectedTaxonName = '';
    let selectedTaxonId   = null;
    let selectedTaxonomy   = null;

    const searchInput = document.getElementById('taxonSearchInput');
    const searchBtn   = document.getElementById('taxonSearchBtn');
    const suggestions = document.getElementById('taxonSuggestions');
    const detail      = document.getElementById('taxonDetail');
    const detailBody  = document.getElementById('taxonDetailBody');
    const selectBtn   = document.getElementById('taxonSelectBtn');
    const backBtn     = document.getElementById('taxonBackBtn');
    const loading     = document.getElementById('taxonLoading');
    const errorBox    = document.getElementById('taxonError');

    function showLoading()  { loading.style.display = 'block'; errorBox.style.display = 'none'; }
    function hideLoading()  { loading.style.display = 'none'; }
    function showError(msg) { errorBox.textContent = msg; errorBox.style.display = 'block'; }

    function resetResults() {
        suggestions.innerHTML     = '';
        suggestions.style.display = 'none';
        detail.style.display      = 'none';
        detailBody.innerHTML      = '';
        errorBox.style.display    = 'none';
        selectBtn.style.display   = 'none';
        selectedTaxonId           = null;
        selectedTaxonName         = '';
        selectedTaxonomy         = null;
    }

    // ── Search (taxon_suggest) ──────────────────────────────
    async function doSearch() {
        const q = searchInput.value.trim();
        if (!q) return;

        resetResults();
        showLoading();

        try {
            const res  = await fetch(`/api/organism/query/${encodeURIComponent(q)}`);
            const data = await res.json();
            hideLoading();

            const items = data.sci_name_and_ids ?? data.suggestions ?? [];
            if (!items.length) { showError('No results found.'); return; }

            items.forEach(item => {
                const name       = item.sci_name    ?? item.name  ?? '';
                const taxId      = item.tax_id      ?? item.id    ?? '';
                const rank       = item.rank        ?? '';
                const commonName = item.common_name ?? '';
                const mergedIds  = Array.isArray(item.merged_tax_ids) && item.merged_tax_ids.length
                                    ? item.merged_tax_ids.join(', ') : '';

                const badges = [
                    taxId      ? `<span class="badge bg-secondary me-1">Tax ID: ${taxId}</span>` : '',
                    rank       ? `<span class="badge bg-info text-dark me-1">${rank}</span>` : '',
                    commonName ? `<span class="badge bg-light text-dark border me-1">${commonName}</span>` : '',
                    mergedIds  ? `<span class="badge bg-warning text-dark">Merged: ${mergedIds}</span>` : '',
                ].join('');

                const knownKeys = new Set(['sci_name','name','tax_id','id','rank','common_name','merged_tax_ids']);
                const extras = Object.entries(item)
                    .filter(([k]) => !knownKeys.has(k) && item[k] !== null && item[k] !== '')
                    .map(([k, v]) => `<small class="text-muted me-2"><strong>${k}:</strong> ${v}</small>`)
                    .join('');

                const li = document.createElement('li');
                li.className = 'list-group-item list-group-item-action';
                li.style.cursor = 'pointer';
                li.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start">
                        <strong>${name}</strong>
                        <div>${badges}</div>
                    </div>
                    ${extras ? `<div class="mt-1">${extras}</div>` : ''}
                `;
                li.addEventListener('click', () => fetchDetail(taxId, name));
                suggestions.appendChild(li);
            });
            suggestions.style.display = 'block';
        } catch (e) {
            hideLoading();
            showError('Failed to fetch suggestions. Please try again.');
        }
    }

    // ── Helpers ─────────────────────────────────────────────

    // slug_case / camelCase → Title Case
    function toLabel(key) {
        return key
            .replace(/_/g, ' ')
            .replace(/([a-z])([A-Z])/g, '$1 $2')
            .replace(/\b\w/g, c => c.toUpperCase());
    }

    // lineage is rendered specially in the sidebar — skip it from the main tree
    const LINEAGE_KEY = 'lineage';

    // Recursively render any value as HTML rows into a <tbody>
    // depth controls indentation of section headers
    function renderRows(obj, depth) {
        if (!obj || typeof obj !== 'object') return '';

        return Object.entries(obj).map(([key, value]) => {
            const label = toLabel(key);

            // null / empty string / empty array → single dash row
            if (value === null || value === undefined || value === '' ||
                (Array.isArray(value) && value.length === 0)) {
                return rowHtml(label, '<span class="text-muted">—</span>', depth);
            }

            // boolean → plain text
            if (typeof value === 'boolean') {
                return rowHtml(label, value ? 'Yes' : 'No', depth);
            }

            // primitive
            if (typeof value !== 'object') {
                return rowHtml(label, String(value), depth);
            }

            // array of primitives → comma / line joined
            if (Array.isArray(value) && typeof value[0] !== 'object') {
                return rowHtml(label, value.join('<br>'), depth);
            }

            // array of objects → section header + each item indented
            if (Array.isArray(value)) {
                const inner = value.map((item, i) => {
                    if (typeof item !== 'object') return rowHtml(`#${i+1}`, String(item), depth + 1);
                    // if array has >1 item, add a numbered sub-header
                    const prefix = value.length > 1
                        ? `<tr><td colspan="2" class="taxon-array-index ps-${(depth+1)*3}"><i class="ri-corner-down-right-line me-1"></i>#${i+1}</td></tr>`
                        : '';
                    return prefix + renderRows(item, depth + 1);
                }).join('');
                return sectionHtml(label, inner, depth);
            }

            // plain object → section header + children
            return sectionHtml(label, renderRows(value, depth + 1), depth);
        }).join('');
    }

    function rowHtml(label, value, depth) {
        const indent = depth * 20; // px
        return `<tr>
            <td style="padding-left:${indent + 8}px">${label}</td>
            <td>${value}</td>
        </tr>`;
    }

    function sectionHtml(label, inner, depth) {
        const indent = depth * 20;
        return `<tr>
            <td colspan="2" class="taxon-section-header" style="padding-left:${indent + 8}px">${label}</td>
        </tr>${inner}`;
    }

    // lineage array → sidebar panel (rendered separately)
    function renderLineage(lineage) {
        if (!Array.isArray(lineage) || !lineage.length) return '';
        const items = lineage.map(l => {
            const name = l.organism_name ?? l.name ?? '';
            const rank = (l.rank ?? '').toLowerCase().replace(/_/g, ' ');
            return `<div class="taxon-lineage-item">
                        <span class="lineage-name">${name}</span>
                        <span class="lineage-rank">${rank || 'no rank'}</span>
                    </div>`;
        }).join('');
        return `<div class="taxon-lineage-panel"><h6>Lineage</h6>${items}</div>`;
    }

    // ── Build the full detail page ──────────────────────────
    function renderDetail(taxonomy, fallbackName) {
        const name    = taxonomy.organism_name ?? taxonomy.current_scientific_name?.name ?? fallbackName;
        const lineage = taxonomy[LINEAGE_KEY] ?? null;

        // Render taxonomy without the lineage key (goes to sidebar)
        const withoutLineage = Object.fromEntries(
            Object.entries(taxonomy).filter(([k]) => k !== LINEAGE_KEY)
        );

        const tableRows      = renderRows(withoutLineage, 0);
        const lineageSidebar = renderLineage(lineage);

        const mainCol = `
            <div class="${lineageSidebar ? 'col-md-8' : 'col-12'} taxon-detail-page">
                <div class="taxon-organism-name">${name}</div>
                <div class="taxon-section-title">Name details</div>
                <table class="taxon-name-table">
                    <tbody>${tableRows}</tbody>
                </table>
            </div>`;

        const sideCol = lineageSidebar
            ? `<div class="col-md-4">${lineageSidebar}</div>`
            : '';

        return `<div class="row g-3">${mainCol}${sideCol}</div>`;
    }

    // ── Fetch detail (name_report) ──────────────────────────
    async function fetchDetail(taxId, fallbackName) {
        suggestions.style.display = 'none';
        detail.style.display      = 'none';
        selectBtn.style.display   = 'none';
        showLoading();

        try {
            const res  = await fetch(`/api/organism/name/${encodeURIComponent(taxId)}`);
            const data = await res.json();
            hideLoading();

            const reports  = data.reports ?? data.taxonomy_nodes ?? [];
            const report   = reports[0] ?? {};
            const taxonomy = report.taxonomy ?? report;

            detailBody.innerHTML      = renderDetail(taxonomy, fallbackName);
            selectedTaxonId           = taxonomy.tax_id ?? taxId;
            selectedTaxonName         = taxonomy.organism_name ?? taxonomy.current_scientific_name?.name ?? fallbackName;
            selectedTaxonomy         = taxonomy;

            detail.style.display    = 'block';
            selectBtn.style.display = 'inline-block';
        } catch (e) {
            hideLoading();
            showError('Failed to fetch organism detail. Please try again.');
        }
    }

    // ── Select organism → fill input & close ───────────────
    selectBtn.addEventListener('click', () => {
        const organismInput = document.querySelector('input[name="organism_data"]');
        if (organismInput && selectedTaxonName) {
            organismInput.value = selectedTaxonId
                ? `${selectedTaxonName} - ${selectedTaxonId}`
                : selectedTaxonName;
            organismInput.dispatchEvent(new Event('input'));
        }
        const organismDetail = document.querySelector('input[name="organism_detail"]');
        if (organismDetail && selectedTaxonomy) {
            organismDetail.value = JSON.stringify(selectedTaxonomy);
            organismDetail.dispatchEvent(new Event('input'));
        }
        const organismNameInput = document.querySelector('input[name="organism_name"]');
        if (organismNameInput && selectedTaxonomy) { 
            organismNameInput.value = selectedTaxonomy.current_scientific_name?.name ?? '';
            organismNameInput.dispatchEvent(new Event('input'));
        }
        const taxIdInput = document.querySelector('input[name="taxonomy_id"]');
        if (taxIdInput && selectedTaxonId) {
            taxIdInput.value = selectedTaxonId;
            taxIdInput.dispatchEvent(new Event('input'));
        }
        
        bootstrap.Modal.getInstance(document.getElementById('taxonModal'))?.hide();
    });

    // ── Back to suggestions ─────────────────────────────────
    backBtn.addEventListener('click', e => {
        e.preventDefault();
        detail.style.display      = 'none';
        selectBtn.style.display   = 'none';
        suggestions.style.display = 'block';
    });

    searchBtn.addEventListener('click', doSearch);
    searchInput.addEventListener('keydown', e => { if (e.key === 'Enter') doSearch(); });

    document.getElementById('taxonModal').addEventListener('show.bs.modal', () => {
        resetResults();
        searchInput.value = '';
    });
})();
</script>
