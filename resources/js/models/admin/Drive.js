class Drive {
    static get(params, then) {
        axios.get('/api/admin/drives', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/drives', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.put('/api/admin/drives/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/admin/drives/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static restore(element, then, error) {
        axios.put('/api/admin/drives/' + element+'/restorations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/admin/drives').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name});
            });

            then(elements);
        });
    }


}

export default Drive;
