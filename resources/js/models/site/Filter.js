class Filter {

    static get(then) {
        axios.get('/api/site/filters')
            .then(({data}) => then(data));
    }

    static store(data, then, errors) {
        axios.post('/api/site/filters', data)
            .then(({data}) => then(data))
            .catch(({response}) => errors(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/site/filters/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/site/filters/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Filter;
