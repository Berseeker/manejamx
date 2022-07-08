class AccessoryType {
    static get(params, then) {
        axios.get('/api/accessory-types', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/accessory-types').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({label: element.id, value: element.name});
            });

            then(elements);
        });
    }
    
}

export default AccessoryType;
