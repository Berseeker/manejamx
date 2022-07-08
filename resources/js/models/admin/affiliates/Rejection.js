class Rejection {
    static store(element, then, error) {
        axios.post('/api/admin/affiliates/' + element + '/rejections')
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default Rejection;
