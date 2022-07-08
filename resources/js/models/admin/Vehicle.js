class Vehicle {
    static get(params, then) {
        axios.get('/api/admin/vehicles', {
            params: params
        })
            .then(({data}) => then(data));
    }
    
    static show(element, then) {
        axios.get('/api/admin/vehicles/'+element)
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/vehicles', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/vehicles/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static changeActive(element, then, error) {
        axios.put('/api/admin/vehicles/' + element +'/activations',)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static changeStatus(element, data, then, error) {
        axios.put('/api/admin/vehicles/' + element +'/change-statuses', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static details(element, data, then, error) {
        axios.post('/api/admin/vehicles/' + element+'/details', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static accessories(element, data, then, error) {
        axios.post('/api/admin/vehicles/' + element+'/accessories', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static inspections(element, data, then, error) {
        axios.post('/api/admin/vehicles/' + element+'/inspections', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/vehicles/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Vehicle;
