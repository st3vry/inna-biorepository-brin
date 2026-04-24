<!-- View Organism Detail Modal (Reusable) -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewOrganismDetailModalLabel" aria-hidden="true" id="viewOrganismDetailModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewOrganismDetailModalLabel">Organism Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewOrganismDetailBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.organism-detail-page { font-size: 0.875rem; }
.organism-detail-name {
    font-size: 1.6rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 0.25rem;
}
.organism-detail-section-title {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #6c757d;
    margin-bottom: 0.75rem;
    margin-top: 1.25rem;
}
.organism-detail-tree {
    width: 100%;
    border-collapse: collapse;
}   
.organism-detail-tree tr { border-bottom: 1px solid #f0f0f0;}
.organism-detail-tree td { padding: 0.45rem 0.5rem 0.45rem 0; vertical-align: top; }
.organism-detail-tree td:first-child {
    color: #6c757d;
    width: 210px;
    min-width: 160px;
    white-space: nowrap;
    padding-right: 1.5rem;
}
.organism-detail-tree td:last-child { color: #212529; }
.organism-detail-section-header {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: #6c757d;
    background: #f8f9fa;
    padding-top: 0.75rem !important;
    border-top: 2px solid #dee2e6;
}
.organism-detail-array-index {
    font-size: 0.72rem;
    color: #adb5bd;
    font-weight: 600;
    padding-top: 0.4rem !important;
    padding-bottom: 0.1rem !important;
}
</style>

<script>
document.getElementById('viewOrganismDetailModal').addEventListener('show.bs.modal', function() {
    const detailBody = document.getElementById('viewOrganismDetailBody');
    const data = window.currentOrganismDetail ?? {};

    if (!data || Object.keys(data).length === 0) {
        detailBody.innerHTML = '<p class="text-muted">No organism detail available.</p>';
        return;
    }

    function toLabel(key) {
        return key
            .replace(/_/g, ' ')
            .replace(/([a-z])([A-Z])/g, '$1 $2')
            .replace(/\b\w/g, c => c.toUpperCase());
    }

    function renderRows(obj, depth) {
        if (!obj || typeof obj !== 'object') return '';
        return Object.entries(obj).map(([key, value]) => {
            const label = toLabel(key);
            if (value === null || value === undefined || value === '' || (Array.isArray(value) && value.length === 0)) {
                return rowHtml(label, '<span class="text-muted">—</span>', depth);
            }
            if (typeof value === 'boolean') {
                return rowHtml(label, value ? 'Yes' : 'No', depth);
            }
            if (typeof value !== 'object') {
                return rowHtml(label, String(value), depth);
            }
            if (Array.isArray(value) && typeof value[0] !== 'object') {
                return rowHtml(label, value.join('<br>'), depth);
            }
            if (Array.isArray(value)) {
                const inner = value.map((item, i) => {
                    if (typeof item !== 'object') return rowHtml(`#${i+1}`, String(item), depth + 1);
                    const prefix = value.length > 1
                        ? `<tr><td colspan="2" class="organism-detail-array-index" style="padding-left:${(depth+1)*20 + 8}px"><i class="ri-corner-down-right-line me-1"></i>#${i+1}</td></tr>`
                        : '';
                    return prefix + renderRows(item, depth + 1);
                }).join('');
                return sectionHtml(label, inner, depth);
            }
            return sectionHtml(label, renderRows(value, depth + 1), depth);
        }).join('');
    }

    function rowHtml(label, value, depth) {
        const indent = depth * 20;
        return `<tr><td style="padding-left:${indent + 8}px">${label}</td><td>${value}</td></tr>`;
    }

    function sectionHtml(label, inner, depth) {
        const indent = depth * 20;
        return `<tr><td colspan="2" class="organism-detail-section-header" style="padding-left:${indent + 8}px">${label}</td></tr>${inner}`;
    }

    const name = data.organism_name ?? data.current_scientific_name?.name ?? 'Organism Detail';
    const tableRows = renderRows(data, 0);

    detailBody.innerHTML = `
        <div class="organism-detail-page">
            <div class="organism-detail-name">${name}</div>
            <div class="organism-detail-section-title">Details</div>
            <table class="organism-detail-tree">
                <tbody>${tableRows}</tbody>
            </table>
        </div>`;
});
</script>
