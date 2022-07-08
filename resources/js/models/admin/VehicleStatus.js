class VehicleStatus {
    static get(params, then) {
        axios.get('/api/admin/vehicle-statuses', {
            params: params
        })
            .then(({data}) => then(data));
    }
    
}

export default VehicleStatus;
