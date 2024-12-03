document.addEventListener('DOMContentLoaded', () => {
    const instances = [
        { areaId: 'filterArea', parameterId: 'filterParameter' },
        { areaId: 'area', parameterId: 'parameter' },
        { areaId: 'currentArea', parameterId: 'currentParameter' }
        // Add more instances as needed
    ];

    instances.forEach(({ areaId, parameterId }) => {
        const parameterSelect = new ParameterSelect(parameterId);
        new AreaSelect(areaId, parameterSelect);
    });
});
