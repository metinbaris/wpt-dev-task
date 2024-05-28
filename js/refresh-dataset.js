class RefreshDataset {
    constructor() {
        this.tableBody = document.getElementById('dataset');
        this.intervalInMs = 60 * 60 * 1000; // 60 Minutes interval
    }

    async updateDataset(data) {
        this.tableBody.innerHTML = '';

        if (data.length === 0) {
            return;
        }

        data.forEach(dataset => {
            this.renderRow(dataset);
        });
    }

    renderRow(dataset) {
        const row = document.createElement('tr');

        const taskCell = document.createElement('td');
        taskCell.textContent = dataset.task;

        const titleCell = document.createElement('td');
        titleCell.textContent = dataset.title;

        const descriptionCell = document.createElement('td');
        descriptionCell.textContent = dataset.description;

        const colorCodeCell = document.createElement('td');
        colorCodeCell.style.color = dataset.colorCode;
        colorCodeCell.textContent = dataset.colorCode;

        row.appendChild(taskCell);
        row.appendChild(titleCell);
        row.appendChild(descriptionCell);
        row.appendChild(colorCodeCell);

        this.tableBody.appendChild(row);
    }

    async refreshDataset() {
        try {
            const headers = new Headers({ 'REFRESHDATASET': 'REFRESHDATASET' });
            const response = await fetch('/', { headers: headers });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            await this.updateDataset(data);
            searchDataset.setSearchData();
        } catch (error) {
            console.error('Failed to refresh dataset:', error);
        }
    }

    startAutoRefresh() {
        setInterval(() => this.refreshDataset(), this.intervalInMs);
    }
}

const refreshDataset = new RefreshDataset();
refreshDataset.startAutoRefresh();
