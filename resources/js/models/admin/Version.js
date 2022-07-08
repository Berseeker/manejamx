class Version {
    static get(params, then) {
        axios.get('/api/admin/versions', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(params,then) {
        axios.get('/api/admin/versions',{
            params: params
        }).then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name, year:element.year});
            });

            then(elements);
        });
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/versions/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static store(data, then, error) {
        axios.post('/api/admin/versions/', data)
             .then(({data}) => then(data))
             .catch(({response}) => error(response.data.errors));
    }
}

export default Version;
