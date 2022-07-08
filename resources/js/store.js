import Vue from 'vue';
import Vehicle from "./models/Vehicle";
import Like from "./models/Like";

const state = Vue.observable({
    savedFilters: [],
    favVehicles: []
});

export const getters = {
    favVehicles: () => state.favVehicles
}

export const mutations = {
    setFavVehicles: (val) => state.favVehicles = val
}

export const actions = {
    getFavVehicles() {
        let filter = {
            sort: {
                name: 'FECHA',
                    order_by: 'created_at',
                    active: true,
                    order: 'Asc',
                    icon: 'fas fa-sort-amount-down-alt'
            },
            order_by: 'created_at',
                order: 'Asc',
                liked_by_user: true,
        }
        Vehicle.get(filter, data => {
            mutations.setFavVehicles(data.data)
        });
    },

    addFavVehicle(vehicle) {
        state.favVehicles.unshift(vehicle);
    },

    toggleFavVehicle(vehicle_id) {
        Like.update(this.vehicle.id, data => {

            if (data.data.liked) {
                this.addFavVehicle(data.data)
            } else {
                let index = state.favVehicles.findIndex(function(vehicle){
                    return vehicle.id === vehicle_id;
                })

                if (index !== -1) state.favVehicles.splice(index, 1);
            }

        }, errors => {
            this.errors = errors.data.errors
            if (errors.status === 401) {
                $('#authModal').modal('show')
            }
        });
    },

    removeFavVehicle(vehicle_id) {
        Like.update(vehicle_id, data => {

            let index = state.favVehicles.findIndex(function(vehicle){
                return vehicle.id === vehicle_id;
            })

            if (index !== -1) state.favVehicles.splice(index, 1);

        }, errors => {});
    }
}