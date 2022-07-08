class Role {
    static get(params, then) {
        axios.get('/api/admin/roles', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/roles', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/roles/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/roles/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Role;
