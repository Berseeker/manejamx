class ExternalVehicle {
    static get(params, then) {
        axios.get('/api/admin/external-vehicles', {
            params: params
        })
            .then(({data}) => then(data));
    }
}

export default ExternalVehicle;
