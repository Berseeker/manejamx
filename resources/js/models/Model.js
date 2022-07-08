class Model {
    static get(params, then) {
        axios.get('/api/models', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(params, then) {
        axios.get('/api/models', {
            params: params
        }).then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name, brand_id: element.brand_id});
            });

            then(elements);
        });
    }
}

export default Model;
