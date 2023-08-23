const filterRadioButtons = document.querySelectorAll('[name="filter-radio"]');
const searchInput = document.getElementById('table-search');
const tableRows = document.querySelectorAll('.table-row');

filterRadioButtons.forEach(button => {
    button.addEventListener('change', () => {
        // Aquí puedes implementar la lógica para filtrar los resultados según el radio seleccionado
    });
});

searchInput.addEventListener('input', () => {
    const searchText = searchInput.value.toLowerCase();

    tableRows.forEach(row => {
        const rowData = row.textContent.toLowerCase();
        row.style.display = rowData.includes(searchText) ? 'table-row' : 'none';
    });
});


filterRadioButtons.forEach(button => {
    button.addEventListener('change', () => {
        const selectedValue = button.value;

        tableRows.forEach(row => {
            const rowData = row.querySelector(`[data-${selectedValue}]`);
            if (rowData) {
                const cellValue = rowData.getAttribute(`data-${selectedValue}`);
                const rowDisplay = cellValue.toLowerCase() === selectedValue ? 'table-row' : 'none';
                row.style.display = rowDisplay;
            }
        });
    });
});
