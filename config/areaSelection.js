const areaOptions = ['Select Area', 'Area 1', 'Area 2', 'Area 3', 'Area 4', 'Area 5', 'Area 6', 'Area 7', 'Area 8', 'Area 9', 'Area 10'];

class AreaSelect {
    constructor(selectId, parameterSelect) {
        this.selectId = selectId;
        this.parameterSelect = parameterSelect;
        this.areaSelect = document.getElementById(selectId);
        this.createAreaSelect();
    }

    createAreaSelect() {
        // Populate existing select element
        areaOptions.forEach(area => {
            const option = document.createElement('option');
            option.value = area; 
            option.textContent = area;
            this.areaSelect.appendChild(option);
        });

        this.areaSelect.onchange = () => this.updateParameters();
    }

    updateParameters() {
        const selectedArea = this.areaSelect.value;
        this.parameterSelect.updateParameters(selectedArea);
    }
}
