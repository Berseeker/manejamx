class Permission {
    static get(params, then) {
        axios.get('/api/admin/permissions', {
            params: params
        })
            .then(({data}) => then(data));
    }
}

export default Permission;
