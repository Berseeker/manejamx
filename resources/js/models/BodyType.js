class BodyType {
    static get(params, then) {
        axios.get('/api/body-types', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/body-types', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.post('/api/body-types/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/body-types/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default BodyType;
