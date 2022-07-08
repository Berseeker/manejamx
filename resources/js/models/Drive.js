class Drive {
    static get(params, then) {
        axios.get('/api/drives', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/drives', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.put('/api/drives/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/drives/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default Drive;
