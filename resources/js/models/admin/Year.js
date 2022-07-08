class Year {
    static get(params, then) {
        axios.get('/api/admin/years', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/years').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, label: element.name});
            });

            then(elements);
        });
    }

}

export default Year;
