class VehicleSide {
    static get(params, then) {
        axios.get('/api/admin/vehicle-sides', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/vehicle-sides', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.put('/api/admin/vehicle-sides/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/admin/vehicle-sides/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default VehicleSide;
