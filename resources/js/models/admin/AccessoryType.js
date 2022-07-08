class AccessoryType {
    static get(params, then) {
        axios.get('/api/admin/accessory-types', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/accessory-types').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({label: element.id, value: element.name});
            });

            then(elements);
        });
    }
    
    static store(data, then, error) {
        axios.post('/api/admin/accessory-types', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static update(element, data, then, error) {
        axios.put('/api/admin/accessory-types/' + element, data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static destroy(element, then, error) {
        axios.delete('/api/admin/accessory-types/' + element)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
    
    static restore(element, then, error) {
        axios.put('/api/admin/accessory-types/' + element+'/restorations')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

}

export default AccessoryType;
