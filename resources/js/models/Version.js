class Version {
    static get(params, then) {
        axios.get('/api/versions', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static update(element, data, then, error) {
        axios.put('/api/versions/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Version;
