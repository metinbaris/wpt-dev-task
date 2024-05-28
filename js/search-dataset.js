class SearchDataset {
    constructor() {
        this.searchInput = document.getElementById('search');
        this.searchTimeout = null;
        this.setSearchData();

        this.searchInput.addEventListener('keyup', () => this.delayedSearch());
    }

    delayedSearch() {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => this.search(), 600);
    }

    search() {
        const query = this.searchInput.value.toLowerCase();

        if (query.length > 0) {
            this.rows.forEach(row => {
                const cells = Array.from(row.getElementsByTagName('td'));
                const showRow = cells.some(cell => cell.textContent.toLowerCase().includes(query));
                row.style.display = showRow ? '' : 'none';
            });
        } else {
            this.resetTable();
        }
    }

    resetTable() {
        this.rows.forEach((row, index) => {
            row.innerHTML = this.defaultResults[index];
            row.style.display = '';
        });
    }

    setSearchData() {
        this.searchInput.value = ''
        const dataset = document.getElementById('dataset');
        this.rows = Array.from(dataset.getElementsByTagName('tr'));
        this.defaultResults = this.rows.map(row => row.innerHTML);
    }
}

const searchDataset = new SearchDataset();
