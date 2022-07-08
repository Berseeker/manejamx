class Accessory {
    static get(params, then) {
        axios.get('/api/admin/accessories', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static store(data, then, error) {
        axios.post('/api/admin/accessories', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static update(element, data, then, error) {
        axios.put('/api/admin/accessories/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, then, error) {
        axios.delete('/api/admin/accessories/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static restore(element, then, error) {
        axios.put('/api/admin/accessories/' + element+'/restorations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static pluck(then) {
        axios.get('/api/admin/accessories').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name, type:element.type.name});
            });

            then(elements);
        });
    }

}

export default Accessory;
