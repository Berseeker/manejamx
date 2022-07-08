class VehicleSellRequest {
    static get(params, then) {
        axios.get('/api/admin/vehicles/sell-requests', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/vehicles/sell-requests/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default VehicleSellRequest;
