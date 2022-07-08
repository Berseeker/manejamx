class FileType {
    static get(params, then) {
        axios.get('/api/admin/file-types', {
            params: params
        })
            .then(({data}) => then(data));
    }

    static pluck(then) {
        axios.get('/api/admin/file-types').then(({data}) => {
            let elements = [];
            data.data.forEach(element => {
                elements.push({id: element.id, name: element.name});
            });

            then(elements);
        });
    }

}

export default FileType;
