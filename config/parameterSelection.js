const parameters = {
    'Area 1': ['Parameter A', 'Parameter B'],
    'Area 2': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E', 'Parameter F', 'Parameter G'],
    'Area 3': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E', 'Parameter F'],
    'Area 4': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E'],
    'Area 5': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D'],
    'Area 6': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D'],
    'Area 7': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E', 'Parameter F', 'Parameter G'],
    'Area 8': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E', 'Parameter F', 'Parameter G', 'Parameter H', 'Parameter I', 'Parameter J'],
    'Area 9': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D'],
    'Area 10': ['Parameter A', 'Parameter B', 'Parameter C', 'Parameter D', 'Parameter E', 'Parameter F', 'Parameter G', 'Parameter H']
};

class ParameterSelect {
    constructor(selectId) {
        this.selectId = selectId;
        this.parameterSelect = document.getElementById(selectId);
        this.parameterSelect.innerHTML = '<option value="Select Parameter">Select Parameter</option>'; // Initialize with default option
    }

    updateParameters(selectedArea) {
        // Clear existing options
        this.parameterSelect.innerHTML = '<option value="Select Parameter">Select Parameter</option>';

        if (selectedArea && parameters[selectedArea]) {
            parameters[selectedArea].forEach(param => {
                const option = document.createElement('option');
                option.value = param;
                option.textContent = param;
                this.parameterSelect.appendChild(option);
            });
        }
    }
}
