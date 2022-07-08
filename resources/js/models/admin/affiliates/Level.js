class Level {
    static get(params, then) {
        axios.get('/api/admin/affiliates/levels', {
            params: params
        })
        .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/affiliates/levels', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.post('/api/admin/affiliates/levels/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/affiliates/levels/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Level;
