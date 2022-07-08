class VehicleImage {
    
    static store(element, data, then, error) {
        axios.post('/api/admin/vehicles/' + element+'/images', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static order(element, data, then, error) {
        axios.put('/api/admin/vehicles/' + element+'/order-images', data)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }

    static destroy(element, file_id, then, error) {
        axios.delete('/api/admin/vehicles/' + element+'/images/'+file_id)
            .then(({data}) => then(data))
            .catch(({response}) => error(response.data.errors));
    }
}

export default VehicleImage;
