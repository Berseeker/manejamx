class BodyType {
    static get(params, then) {
        axios.get('/api/admin/body-types', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/body-types', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.post('/api/admin/body-types/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/admin/body-types/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static restore(element, then, error) {
        axios.put('/api/admin/body-types/' + element+'/restorations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/admin/body-types').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name});
            });

            then(elements);
        });
    }

}

export default BodyType;
