class User {
    static get(params, then) {
        axios.get('/api/admin/users', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/users', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        console.log(element)
        axios.put('/api/admin/users/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/users/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default User;
