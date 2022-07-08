class Brand {
    static get(params, then) {
        axios.get('/api/brands', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/brands').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name});
            });

            then(elements);
        });
    }

}

export default Brand;
