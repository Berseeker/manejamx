class VehicleSellRequest {
   
    static store(data, then, error) {
        axios.post('/api/vehicle-sell-requests', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default VehicleSellRequest;
