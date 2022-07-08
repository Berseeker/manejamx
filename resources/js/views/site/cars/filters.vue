<template>
    <div>
        <div class="container-fluid bg-white">
            <div class="pt-4">
                <div class="search">
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-lg"><span class="fa fa-search"></span></span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Búsqueda por marca, modelo, o cualquier palabra clave">
                        <div class="input-group-append">
                            <button class="btn btn-primary d-none" type="button" id="button-addon2">Buscar</button>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 pb-4 no-gutters filter d-md-none">
                    <div class="col-3 pr-1">
                        <button type="button" class="btn btn-outline-secondary btn-block text-left" data-toggle="modal" data-target="#priceFilterModal"  >
                            Precio
                        </button>
                    </div>
                    <div class="col-3 pr-1 pl-1">
                        <button type="button" class="btn btn-outline-secondary btn-block text-left" data-toggle="modal" data-target="#brandFilterModal"  >
                            Marca
                        </button>
                    </div>
                    <div class="col-3 pr-1 pl-1">
                        <button type="button" class="btn btn-outline-secondary btn-block text-left" data-toggle="modal" data-target="#bodyFilterModal"  >
                            Tipo
                        </button>
                    </div>
                    <div class="col-3 pl-1">
                        <button type="button" class="btn btn-outline-secondary btn-block text-left" data-toggle="modal" data-target="#moreFilterModal"  >
                            Mas <span class="fa fa-caret-right float-right mt-1 text-theme-secondary fa-lg"></span>
                        </button>
                    </div>
                </div>

                <div class="row mt-3 pb-4 no-gutters  filter d-md-block d-sm-none">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item dropdown pr-1">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">PRECIO</a>
                            <div class="dropdown-menu">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <!-- <div class="btn-group-switch">
                                                <div class="btn-group btn-group-lg btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-secondary btn-switch btn-switch-first  active">
                                                        <input type="radio" name="options" id="option1" checked> <strong>PRECIO</strong>
                                                    </label>

                                                    <label class="btn btn-secondary btn-switch btn-switch-last">
                                                        <input type="radio" name="options" id="option3"> <strong>FINANCIAMIENTO</strong>
                                                    </label>
                                                </div>
                                            </div> -->

                                            <div class="row no-gutters mt-4">
                                                <div class="col-5">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">Rango de Precio</label>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" class="form-control" v-model="filter.price[0]">
                                                    </div>
                                                </div>
                                                <div class="col-1 text-center pt-1">-</div>
                                                <div class="col">
                                                    <div class="input-group mb-3 ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">$</span>
                                                        </div>
                                                        <input type="text" class="form-control" v-model="filter.price[1]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container">
                                                <vue-slider v-if="price.active" :min="price_ranges[0]" :max="price_ranges[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.price" width="auto" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                            </div>
                                            <div class="mt-1">
                                                <span class="float-left vue-slider-label">{{price_ranges[0] | currency}}</span>
                                                <span class="float-right vue-slider-label">{{price_ranges[1] | currency}}</span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card border-theme mt-4">
                                                <div class="card-body">
                                                    <h5 class="card-title mt-2">APLICAR UN VALOR COMERCIAL</h5>
                                                    <div class="row  w-lg-500 ">
                                                        <div class="col-3">
                                                            <svg width="62" height="49" viewBox="0 0 62 49" fill="none" xmlns="http://www.w3.org/2000/svg" data-qa="trade-in"><mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="21" width="37" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 21.6025H36.4579V48.4375H0V21.6025Z" fill="white"></path></mask><g mask="url(#mask0)"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.9639 46.4375C13.5049 46.4375 11.5049 44.4375 11.5049 41.9785C11.5049 39.5205 13.5049 37.5195 15.9639 37.5195C18.4229 37.5195 20.4229 39.5205 20.4229 41.9785C20.4229 44.4375 18.4229 46.4375 15.9639 46.4375ZM30.4139 40.9785H22.3369C21.8549 37.8915 19.1849 35.5195 15.9639 35.5195C12.7429 35.5195 10.0729 37.8915 9.59088 40.9785H1.99988V34.3405C1.99988 31.1685 4.62888 31.0015 5.15988 31.0005H10.5469C10.7689 31.0005 10.9839 30.9275 11.1579 30.7925L21.5589 22.7535L19.7779 21.6025L10.2059 29.0005H5.16988C5.09788 29.0045 2.94688 28.9985 1.43988 30.4915C0.484878 31.4375 -0.00012207 32.7325 -0.00012207 34.3405V41.9785C-0.00012207 42.5305 0.446878 42.9785 0.999878 42.9785H9.59088C10.0729 46.0655 12.7429 48.4375 15.9639 48.4375C19.1849 48.4375 21.8549 46.0655 22.3369 42.9785H30.4139V45.4695L36.4579 41.9785L30.4139 38.4885V40.9785Z" fill="#00619E"></path></g><mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="21" y="17" width="41" height="32"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.8818 17H61.9998V48.4379H21.8818V17Z" fill="white"></path></mask><g mask="url(#mask1)"><path fill-rule="evenodd" clip-rule="evenodd" d="M46.2148 46.438C43.7558 46.438 41.7558 44.438 41.7558 41.979C41.7558 39.521 43.7558 37.52 46.2148 37.52C48.6738 37.52 50.6738 39.521 50.6738 41.979C50.6738 44.438 48.6738 46.438 46.2148 46.438ZM61.8858 34.69C61.7648 34.46 58.8708 29.137 50.4998 28.964L41.3188 19.783C41.1318 19.596 40.8778 19.49 40.6118 19.49H27.9268V17L21.8818 20.49L27.9268 23.981V21.49H40.1978L49.3738 30.667C49.5618 30.855 49.8158 30.96 50.0808 30.96C56.7298 30.96 59.4328 34.541 59.9998 35.429V40.979H52.5888C52.1058 37.892 49.4358 35.52 46.2148 35.52C42.6528 35.52 39.7558 38.417 39.7558 41.979C39.7558 45.541 42.6528 48.438 46.2148 48.438C49.4358 48.438 52.1058 46.066 52.5888 42.979H60.9998C61.5528 42.979 61.9998 42.531 61.9998 41.979V35.155C61.9998 34.993 61.9608 34.834 61.8858 34.69Z" fill="#00AED9"></path></g><mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="33" y="0" width="25" height="24"><path fill-rule="evenodd" clip-rule="evenodd" d="M33.3936 0H57.3936V23.3897H33.3936V0Z" fill="white"></path></mask><g mask="url(#mask2)"><path fill-rule="evenodd" clip-rule="evenodd" d="M35.3936 12C35.3936 6.486 39.8796 2 45.3936 2C50.9076 2 55.3936 6.486 55.3936 12C55.3936 16.783 52.0166 20.787 47.5236 21.766L49.1476 23.39C53.9296 21.81 57.3936 17.305 57.3936 12C57.3936 5.383 52.0106 0 45.3936 0C38.7766 0 33.3936 5.383 33.3936 12C33.3936 13.596 33.7126 15.117 34.2816 16.512H36.4816C35.7906 15.154 35.3936 13.624 35.3936 12Z" fill="#00AED9"></path></g><path fill-rule="evenodd" clip-rule="evenodd" d="M47.0274 14.8635C46.8114 15.0335 46.5054 15.1605 46.1164 15.2415V12.7415C46.5074 12.8145 46.8154 12.9305 47.0344 13.0875C47.2634 13.2535 47.3764 13.5415 47.3764 13.9665C47.3764 14.3855 47.2624 14.6795 47.0274 14.8635ZM44.9094 10.8745C44.5384 10.7945 44.2594 10.6715 44.0814 10.5065C43.8814 10.3205 43.7834 10.0645 43.7834 9.72245C43.7834 9.02145 44.1514 8.60545 44.9094 8.45645V10.8745ZM48.3044 11.8155C47.8574 11.4445 47.2264 11.1945 46.4314 11.0725L46.1164 11.0265V8.43545C46.4364 8.48145 46.7024 8.55045 46.9064 8.64245C47.1274 8.74345 47.3644 8.90045 47.6144 9.10645L47.7324 9.20345L48.9094 8.04545L48.7684 7.92545C48.2974 7.52045 47.8944 7.25245 47.5364 7.10445C47.2134 6.97045 46.7724 6.87345 46.2244 6.81545V6.06445H44.7864V6.83845C44.3594 6.91045 43.9924 7.00945 43.6984 7.13045C43.3594 7.27145 43.0384 7.50245 42.7424 7.81845C42.2634 8.34445 42.0204 9.01245 42.0204 9.80345C42.0204 10.5685 42.2624 11.2065 42.7394 11.6975C43.2134 12.1865 43.8754 12.4815 44.7064 12.5745L44.9094 12.5985V15.2745C44.4784 15.2315 44.1174 15.1465 43.8334 15.0195C43.5694 14.9005 43.2744 14.6915 42.9554 14.3975L42.8364 14.2875L41.6204 15.5035L41.7494 15.6235C42.2504 16.0875 42.7354 16.4155 43.1914 16.5985C43.6084 16.7665 44.1454 16.8785 44.7864 16.9315V17.9345H46.2244V16.8775C46.8344 16.7785 47.2794 16.6515 47.5844 16.4905C48.6334 15.9455 49.1674 15.0835 49.1674 13.9265C49.1674 13.0195 48.8784 12.3105 48.3044 11.8155Z" fill="#00AED9"></path></svg>
                                                        </div>
                                                        <div class="col-9">
                                                            <p>
                                                                Aumenta tu poder adquisitivo respondiendo algunas preguntas sobre tu automóvil, y obtén un valor instantáneo. Solo toma 2 minutos.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="text-center mt-3">
                                                        <a href="#" class="btn btn-outline-primary btn-block">OBTÉN TU VALOR COMERCIAL</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown pr-1 pl-1">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MARCA / MODELO</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <div class="search-secondary">
                                                <div class="input-group input-group-lg">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><span class="fa fa-search"></span></span>
                                                    </div>
                                                    <input type="text" class="form-control rounded-right" v-model="filter.search_brand" @change="fetchBrands" placeholder="Buscar marcas y modelos.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-3" v-for="brands in brand_groups">
                                            <div class="container-fluid">
                                                <div v-for="brand in brands" class="mb-2">
                                                    <a href="" class="font-weight-light">{{brand.name}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown pr-1 pl-1">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">TIPO</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-3" v-for="(body, index) in bodies" :key="'body_'+index">
                                            <a href="#" @click.prevent="setBodyType(index)" class="car-type-check" :class="{'active':body.active}">
                                                <img :src="body.file ? body.file.show_url :''" :alt="body.name" >
                                                <p class="mt-3">{{body.name}} <span v-if="body.active" class="text-theme fa fa-check"></span></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown pr-1 pl-1 d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">AÑO Y KILOMETRAJE</a>
                             <div class="dropdown-menu dropdown-menu-right">
                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="container mb-4">
                                                <div class="row no-gutters mt-4">
                                                    <div class="col-5">
                                                        <label for="" class="mt-1 text-uppercase font-weight-bold">Año</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" v-model="filter.years[0]">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-center pt-1">-</div>
                                                    <div class="col">
                                                        <div class="mb-3 ">
                                                            <input type="text" class="form-control" v-model="filter.years[1]">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <vue-slider :min="filter.years[0]" :max="filter.years[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.years" width="auto" :marks="year_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="container mb-4">
                                                <div class="row no-gutters mt-4">
                                                    <div class="col-5">
                                                        <label for="" class="mt-1 text-uppercase font-weight-bold">kilometraje</label>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <input type="text" class="form-control" v-model="filter.kilometers[0]">
                                                        </div>
                                                    </div>
                                                    <div class="col-1 text-center pt-1">-</div>
                                                    <div class="col">
                                                        <div class="mb-3 ">
                                                            <input type="text" class="form-control" v-model="filter.kilometers[1]">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <vue-slider :min="filter.kilometers[0]" :max="filter.kilometers[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.kilometers" width="auto" :marks="kilometer_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown pr-1 pl-1">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">ACCESORIOS</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="container-fluid mt-4">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-6 mb-4" v-for="(accessory_type,index) in accessory_types" :key="'accessory_type_'+index">
                                                <h5 class="mb-2 text-uppercase text-bold">{{ accessory_type.name}}</h5>
                                                <div class="row">
                                                    <div class="col-6 mt-2" v-for="(accessory, key) in accessory_type.accessories" :key="'accessory_'+key">
                                                        <button type="button" class="btn btn-sm text-left btn-block btn-check" :class="{'active': accessory.active}" @click="setAccessory(index, key)"  ><i class="fa fa-edit"></i> {{accessory.name}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown pr-1 pl-1">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">MÁS FILTROS</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="container-fluid mt-4">
                                    <div class="container-fluid">
                                        <div class="row mt-4 mb-4 d-lg-none">
                                            <div class="col-6">
                                                <div class="container mb-4">
                                                    <div class="row no-gutters mt-4">
                                                        <div class="col-5">
                                                            <label for="" class="mt-1 text-uppercase font-weight-bold">Año</label>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" v-model="filter.years[0]">
                                                            </div>
                                                        </div>
                                                        <div class="col-1 text-center pt-1">-</div>
                                                        <div class="col">
                                                            <div class="mb-3 ">
                                                                <input type="text" class="form-control" v-model="filter.years[1]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <vue-slider :min="filter.years[0]" :max="filter.years[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.years" width="auto" :marks="year_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="container mb-4">
                                                    <div class="row no-gutters mt-4">
                                                        <div class="col-5">
                                                            <label for="" class="mt-1 text-uppercase font-weight-bold">kilometraje</label>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <input type="text" class="form-control" v-model="filter.kilometers[0]">
                                                            </div>
                                                        </div>
                                                        <div class="col-1 text-center pt-1">-</div>
                                                        <div class="col">
                                                            <div class="mb-3 ">
                                                                <input type="text" class="form-control" v-model="filter.kilometers[1]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <vue-slider :min="filter.kilometers[0]" :max="filter.kilometers[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.kilometers" width="auto" :marks="kilometer_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr class="d-md-none">
                                        <div class="row mt-4 mb-4">
                                            <div class="col-6">
                                                <div class="container">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">COMBUSTIBLE</label>
                                                    <div class="row">
                                                        <div v-for="(fuel, index) in fuels" :key="'fuel_'+index" class="col-3">
                                                            <button 
                                                                type="button" 
                                                                class="btn btn-sm btn-block btn-check"  
                                                                :class="{'active':fuel.active}" 
                                                                @click.prevent="setFuelType(index)"  
                                                            >
                                                                {{fuel.name}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="container">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">CILINDROS</label>
                                                    <div class="row">
                                                        <div v-for="(cylinder, index) in cylinders" :key="'cylinder_'+index" class="col-3 text-center mt-2">
                                                            <button type="button" class="btn btn-sm btn-check btn-block" :class="{'active':cylinder.active}" @click="setCylinder(index)" >{{ cylinder.name }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-4 mb-4">
                                            <div class="col-12">
                                                <div class="container">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">COLOR</label>
                                                    <div class="row">
                                                        <div class="col-2" v-for="(color, index) in colors" :key="'color_'+index">
                                                            <a href="#" class="color-check sm" :class="{'active':color.active}" @click.prevent="setColor(index)">
                                                                <span class="color-circle" :class="'circle-'+color.hex"></span>
                                                                <p class="mt-2">
                                                                    {{color.name}} <span v-if="color.active" class="text-theme fa fa-check"></span>
                                                                </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-4 mb-4">
                                            <div class="col-6">
                                                <div class="container">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">TRANSMISIÓN</label>
                                                    <div class="row">
                                                        <div v-for="(transmission, index) in transmissions" :key="'transmissions_'+index" class="col-6 text-center mt-2">
                                                            <button type="button" class="btn btn-sm btn-check btn-block" :class="{'active':transmission.active}" @click="setTransmission(index)" >{{ transmission.name }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="container">
                                                    <label for="" class="mt-1 text-uppercase font-weight-bold">Tracción</label>
                                                    <div class="row">
                                                        <div v-for="(drives, index) in drives" :key="'drives_'+index" class="col-3 text-center mt-2">
                                                            <button type="button" class="btn btn-sm btn-check btn-block" :class="{'active':drives.active}" @click="setDrive(index)" >{{ drives.name }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-2 text-right ">
            <div class="btn-group btn-group-sort">
                <button class="btn btn-link btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    FECHA
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <template v-for="sort in sorts" >
                        <a class="dropdown-item" href="#"><span :class="{'fa fa-check':sort.active}"></span> {{ sort.name }}</a>
                    </template>
                </div>
            </div>
        </div>

        <div class="modal fade filter" id="priceFilterModal" tabindex="-1" aria-labelledby="priceFilterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="priceFilterModalLabel">PRECIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <!-- <div class="btn-group-switch">
                                <div class="btn-group btn-group-lg btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary btn-switch btn-switch-first  active">
                                        <input type="radio" name="options" id="option1" checked> <strong>PRECIO</strong>
                                    </label>

                                    <label class="btn btn-secondary btn-switch btn-switch-last">
                                        <input type="radio" name="options" id="option3"> <strong>FINANCIAMIENTO</strong>
                                    </label>
                                </div>
                            </div> -->
                            <div class="container">
                                <div class="row no-gutters mt-4">
                                    <div class="col-5">
                                        <label for="" class="mt-1">Rango de Precio</label>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" v-model="filter.price[0]">
                                        </div>
                                    </div>
                                    <div class="col-1 text-center pt-1">-</div>
                                    <div class="col">
                                        <div class="input-group mb-3 ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" v-model="filter.price[1]">
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <vue-slider v-if="price.active" :min="price.ranges[0]" :max="price.ranges[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.price" width="auto" :marks="price.marks" :tooltip="'none'" :enable-cross="false" :lazy="true">
                                        <template v-slot:label="{ active, value }">
                                            <div :class="['vue-slider-mark-label', 'custom-label', { active }]">{{ value | currency }}</div>
                                        </template>
                                    </vue-slider>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="card border-theme mt-4">
                                <div class="card-body">
                                    <h5 class="card-title mt-2">APLICAR UN VALOR COMERCIAL</h5>
                                    <div class="row  w-lg-500 ">
                                        <div class="col-3">
                                            <svg width="62" height="49" viewBox="0 0 62 49" fill="none" xmlns="http://www.w3.org/2000/svg" data-qa="trade-in"><mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="21" width="37" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 21.6025H36.4579V48.4375H0V21.6025Z" fill="white"></path></mask><g mask="url(#mask0)"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.9639 46.4375C13.5049 46.4375 11.5049 44.4375 11.5049 41.9785C11.5049 39.5205 13.5049 37.5195 15.9639 37.5195C18.4229 37.5195 20.4229 39.5205 20.4229 41.9785C20.4229 44.4375 18.4229 46.4375 15.9639 46.4375ZM30.4139 40.9785H22.3369C21.8549 37.8915 19.1849 35.5195 15.9639 35.5195C12.7429 35.5195 10.0729 37.8915 9.59088 40.9785H1.99988V34.3405C1.99988 31.1685 4.62888 31.0015 5.15988 31.0005H10.5469C10.7689 31.0005 10.9839 30.9275 11.1579 30.7925L21.5589 22.7535L19.7779 21.6025L10.2059 29.0005H5.16988C5.09788 29.0045 2.94688 28.9985 1.43988 30.4915C0.484878 31.4375 -0.00012207 32.7325 -0.00012207 34.3405V41.9785C-0.00012207 42.5305 0.446878 42.9785 0.999878 42.9785H9.59088C10.0729 46.0655 12.7429 48.4375 15.9639 48.4375C19.1849 48.4375 21.8549 46.0655 22.3369 42.9785H30.4139V45.4695L36.4579 41.9785L30.4139 38.4885V40.9785Z" fill="#00619E"></path></g><mask id="mask1" mask-type="alpha" maskUnits="userSpaceOnUse" x="21" y="17" width="41" height="32"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.8818 17H61.9998V48.4379H21.8818V17Z" fill="white"></path></mask><g mask="url(#mask1)"><path fill-rule="evenodd" clip-rule="evenodd" d="M46.2148 46.438C43.7558 46.438 41.7558 44.438 41.7558 41.979C41.7558 39.521 43.7558 37.52 46.2148 37.52C48.6738 37.52 50.6738 39.521 50.6738 41.979C50.6738 44.438 48.6738 46.438 46.2148 46.438ZM61.8858 34.69C61.7648 34.46 58.8708 29.137 50.4998 28.964L41.3188 19.783C41.1318 19.596 40.8778 19.49 40.6118 19.49H27.9268V17L21.8818 20.49L27.9268 23.981V21.49H40.1978L49.3738 30.667C49.5618 30.855 49.8158 30.96 50.0808 30.96C56.7298 30.96 59.4328 34.541 59.9998 35.429V40.979H52.5888C52.1058 37.892 49.4358 35.52 46.2148 35.52C42.6528 35.52 39.7558 38.417 39.7558 41.979C39.7558 45.541 42.6528 48.438 46.2148 48.438C49.4358 48.438 52.1058 46.066 52.5888 42.979H60.9998C61.5528 42.979 61.9998 42.531 61.9998 41.979V35.155C61.9998 34.993 61.9608 34.834 61.8858 34.69Z" fill="#00AED9"></path></g><mask id="mask2" mask-type="alpha" maskUnits="userSpaceOnUse" x="33" y="0" width="25" height="24"><path fill-rule="evenodd" clip-rule="evenodd" d="M33.3936 0H57.3936V23.3897H33.3936V0Z" fill="white"></path></mask><g mask="url(#mask2)"><path fill-rule="evenodd" clip-rule="evenodd" d="M35.3936 12C35.3936 6.486 39.8796 2 45.3936 2C50.9076 2 55.3936 6.486 55.3936 12C55.3936 16.783 52.0166 20.787 47.5236 21.766L49.1476 23.39C53.9296 21.81 57.3936 17.305 57.3936 12C57.3936 5.383 52.0106 0 45.3936 0C38.7766 0 33.3936 5.383 33.3936 12C33.3936 13.596 33.7126 15.117 34.2816 16.512H36.4816C35.7906 15.154 35.3936 13.624 35.3936 12Z" fill="#00AED9"></path></g><path fill-rule="evenodd" clip-rule="evenodd" d="M47.0274 14.8635C46.8114 15.0335 46.5054 15.1605 46.1164 15.2415V12.7415C46.5074 12.8145 46.8154 12.9305 47.0344 13.0875C47.2634 13.2535 47.3764 13.5415 47.3764 13.9665C47.3764 14.3855 47.2624 14.6795 47.0274 14.8635ZM44.9094 10.8745C44.5384 10.7945 44.2594 10.6715 44.0814 10.5065C43.8814 10.3205 43.7834 10.0645 43.7834 9.72245C43.7834 9.02145 44.1514 8.60545 44.9094 8.45645V10.8745ZM48.3044 11.8155C47.8574 11.4445 47.2264 11.1945 46.4314 11.0725L46.1164 11.0265V8.43545C46.4364 8.48145 46.7024 8.55045 46.9064 8.64245C47.1274 8.74345 47.3644 8.90045 47.6144 9.10645L47.7324 9.20345L48.9094 8.04545L48.7684 7.92545C48.2974 7.52045 47.8944 7.25245 47.5364 7.10445C47.2134 6.97045 46.7724 6.87345 46.2244 6.81545V6.06445H44.7864V6.83845C44.3594 6.91045 43.9924 7.00945 43.6984 7.13045C43.3594 7.27145 43.0384 7.50245 42.7424 7.81845C42.2634 8.34445 42.0204 9.01245 42.0204 9.80345C42.0204 10.5685 42.2624 11.2065 42.7394 11.6975C43.2134 12.1865 43.8754 12.4815 44.7064 12.5745L44.9094 12.5985V15.2745C44.4784 15.2315 44.1174 15.1465 43.8334 15.0195C43.5694 14.9005 43.2744 14.6915 42.9554 14.3975L42.8364 14.2875L41.6204 15.5035L41.7494 15.6235C42.2504 16.0875 42.7354 16.4155 43.1914 16.5985C43.6084 16.7665 44.1454 16.8785 44.7864 16.9315V17.9345H46.2244V16.8775C46.8344 16.7785 47.2794 16.6515 47.5844 16.4905C48.6334 15.9455 49.1674 15.0835 49.1674 13.9265C49.1674 13.0195 48.8784 12.3105 48.3044 11.8155Z" fill="#00AED9"></path></svg>
                                        </div>
                                        <div class="col-9">
                                            <p>
                                                Aumenta tu poder adquisitivo respondiendo algunas preguntas sobre tu automóvil, y obtén un valor instantáneo. Solo toma 2 minutos.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="#" class="btn btn-outline-primary btn-block">OBTÉN TU VALOR COMERCIAL</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block" @click="applyFilter">APLICAR FILTROS</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade filter" id="brandFilterModal" tabindex="-1" aria-labelledby="brandFilterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="brandFilterModalLabel">MARCA / MODELO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="search-secondary">
                                <div class="input-group input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><span class="fa fa-search"></span></span>
                                    </div>
                                    <input type="text" class="form-control rounded-right" placeholder="Buscar marcas y modelos.">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="container-fluid">
                                <h5 class="mb-4 font-weight-light">A</h5>
                                <!-- <div v-for="brand in brands" class="mb-2">
                                    <img :src="brand.path" alt="" class="mr-2">
                                    <a href="" class="font-weight-light">{{brand.name}}</a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">APLICAR FILTROS</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade filter" id="bodyFilterModal" tabindex="-1" aria-labelledby="bodyFilterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="bodyFilterModalLabel">TIPO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6" v-for="(body, index) in bodies" :key="'body_modal_'+index">
                            <a href="#" @click.prevent="setBodyType(index)" class="car-type-check" :class="{'active':body.active}">
                                <img :src="body.file ? body.file.show_url :''" :alt="body.name" width="80">
                                <p class="mt-3">{{body.name}} <span v-if="body.active" class="text-theme fa fa-check"></span></p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">APLICAR FILTROS</button>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade filter" id="moreFilterModal" tabindex="-1" aria-labelledby="moreFilterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="moreFilterModalLabel">MÁS FILTROS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="accordion" id="accordionMore">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        AÑO
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="container mb-4">
                                        <div class="row no-gutters mt-4">
                                            <div class="col-5">
                                                <label for="" class="mt-1">Año</label>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" v-model="filter.years[0]">
                                                </div>
                                            </div>
                                            <div class="col-1 text-center pt-1">-</div>
                                            <div class="col">
                                                <div class="mb-3 ">
                                                    <input type="text" class="form-control" v-model="filter.years[1]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <vue-slider :min="filter.years[0]" :max="filter.years[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.years" width="auto" :marks="year_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        KILOMETRAJE
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="container mb-4">
                                        <div class="row no-gutters mt-4">
                                            <div class="col-5">
                                                <label for="" class="mt-1">kilometraje</label>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" v-model="filter.kilometers[0]">
                                                </div>
                                            </div>
                                            <div class="col-1 text-center pt-1">-</div>
                                            <div class="col">
                                                <div class="mb-3 ">
                                                    <input type="text" class="form-control" v-model="filter.kilometers[1]">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <vue-slider :min="filter.kilometers[0]" :max="filter.kilometers[1]"  :dotSize="18"  :dot-options="dotOptions" v-model="filter.kilometers" width="auto" :marks="kilometer_marks" :tooltip="'none'" :enable-cross="false" :lazy="true"></vue-slider>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        COMBUSTIBLE
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(fuel, index) in fuels" :key="'fuel_modal_'+index" class="col-12 text-center mt-2">
                                            <button 
                                                type="button" 
                                                class="btn btn-check" 
                                                :class="{'active':fuel.active}" 
                                                @click="setFuelType(index)"
                                            >
                                                {{ fuel.name}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        ACCESORIOS
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="container-fluid" v-for="(type, index) in accessory_types" :key="'accessory_type_modal_'+index">
                                        <h5 class="mb-4 font-weight-light">type.name</h5>
                                        <div class="ml-2">
                                            <ul class="list-unstyled fa-ul list-check">
                                                <li class="mt-3" v-for="(accessory, key) in type.accessories" :key="'accessory_modal_'+key">
                                                    <a href="#" :class="{'active':accessory.active}" @click.prevent="setAccessory(index, key)">
                                                        <span class="fa-li"><i class="fa fa-lg fa-edit"></i></span>Cooled Seats <span v-if="accessory.active" class="fa fa-check float-right"></span>
                                                    </a>
                                                </li>                                    
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingColor">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseColor" aria-expanded="false" aria-controls="collapseColor">
                                        COLORES
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseColor" class="collapse" aria-labelledby="headingColor" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3" v-for="(color, index) in colors" :key="'color_modal'+index">
                                            <a href="#" class="color-check" :class="{'active':color.active}" @click.prevent="setColor(index)">
                                                <span class="color-circle" :class="'circle-'+color.hex" ></span>
                                                <p class="mt-2">
                                                    {{color.name}} <span v-if="color.active" class="text-theme fa fa-check"></span>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTransmissions">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTransmissions" aria-expanded="false" aria-controls="collapseTransmissions">
                                        TRANSMISIÓN
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTransmissions" class="collapse" aria-labelledby="headingTransmissions" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(transmission, index) in transmissions" :key="'transmission_modal_'+index" class="col-12 text-center mt-2">
                                            <button type="button" class="btn btn-check" :class="{'active':transmission.active}" @click="setTransmission(index)" >{{ transmission.name }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingCylinders">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCylinders" aria-expanded="false" aria-controls="collapseCylinders">
                                        CILINDROS
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseCylinders" class="collapse" aria-labelledby="headingCylinders" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(cylinder, index) in cylinders" :key="'cylinder_modal_'+index" class="col-12 text-center mt-2">
                                            <button type="button" class="btn btn-check" :class="{'active':cylinder.active}" @click="setCylinder(index)" >{{ cylinder.name }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingDrives">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseDrives" aria-expanded="false" aria-controls="collapseDrives">
                                        TRACCIÓN
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseDrives" class="collapse" aria-labelledby="headingDrives" data-parent="#accordionMore">
                                <div class="card-body">
                                    <div class="row">
                                        <div v-for="(drives, index) in drives" :key="'drives_modal_'+index" class="col-12 text-center mt-2">
                                            <button type="button" class="btn btn-check" :class="{'active':drives.active}" @click="setDrive(index)" >{{ drives.name }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">APLICAR FILTROS</button>
                </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import Brand from '../../../models/Brand';
    import BodyType from '../../../models/BodyType';
    import Fuel from '../../../models/Fuel';
    import Color from '../../../models/Color';
    import Cylinder from '../../../models/Cylinder';
    import Drive from '../../../models/Drive';
    import Transmission from '../../../models/Transmission';
    import AccessoryType from '../../../models/AccessoryType';

    import VueSlider from 'vue-slider-component';
    import 'vue-slider-component/theme/antd.css';

    export default {
        components:{VueSlider},

        props:['price_ranges'],

        data(){
            return{
                dotOptions: [
                    {
                        disabled: false
                    },
                    {
                        disabled: false
                    },
                ],

                price:{
                    active: false,
                    ranges: [0, 0],
                    marks : [0, 0],
                },

                marks: [0, 95000],

                filter:{
                    price: [0, 0],
                    ranges: [0, 95000],
                    
                    years: [2009, 2020],
                    kilometers: [0, 105226],
                },
                year_marks: [2009, 2020],
                year_filter:{
                    from_price:2009,
                    to_price:2020,
                    ranges: [2009, 2020],
                },
                kilometer_marks: [0, 105226],
                kilometer_filter:{
                    from_price:0,
                    to_price:105226,
                    ranges: [0, 105226],
                },
                accessory_types:[],
                fuels:[],
                transmissions:[],
                cylinders:[],
                colors:[],
                drives:[],
                bodies:[],
                brand_groups:[],
                sorts:[
                    {
                        name:'FECHA',
                        active:true,
                        order:'Desc',
                        icon: 'fa fa-desc'
                    },
                    {
                        name:'PRECIO',
                        active:false,
                        order:'Desc',
                        icon: 'fa fa-desc'
                    }
                ],
            }
        },

        created(){
            this.loadData();
        },

        computed:{
            filter_price(){
                return this.filter.price;
            }
        },

        methods:{
            loadData(){
                BodyType.get({}, data => this.bodies = data.data);
                Fuel.get({}, data => this.fuels = data.data);
                Color.get({}, data => this.colors = data.data);
                Color.get({}, data => this.colors = data.data);
                Cylinder.get({}, data => this.cylinders = data.data);
                Transmission.get({}, data => this.transmissions = data.data);
                Drive.get({}, data => this.drives = data.data);
                AccessoryType.get({}, data => this.accessory_types = data.data);
                this.fetchBrands();
            },

            fetchBrands(){
                let parameters = {
                    search: this.filter.search_brand ? this.filter.search_brand : null
                }

                Brand.get(parameters, data => {
                    this.brand_groups = _.chunk(data.data, 8)
                });
            },

            setBodyType(index){
                this.bodies[index].active = !this.bodies[index].active;
            },

            setFuelType(index){
                this.fuels[index].active = !this.fuels[index].active;
            },

            setColor(index){
                this.colors[index].active = !this.colors[index].active;
            },

            setCylinder(index){
                this.cylinders[index].active = !this.cylinders[index].active;
            },
            
            setDrive(index){
                this.drives[index].active = !this.drives[index].active;
            },

            setTransmission(index){
                this.transmissions[index].active = !this.transmissions[index].active;
            },

            setAccessory(type_index, index){
                this.accessory_types[type_index].accessories[index].active = !this.accessory_types[type_index].accessories[index].active;
            },

            applyFilter(){
                this.$parent.filter = this.filter;
                this.$emit('filter');
                $('.modal').modal('hide');
            }

        },

        watch:{
            price_ranges(){
                let price = [parseFloat(this.price_ranges[0]), parseFloat(this.price_ranges[1])];

                this.filter.price  =  this.price.active ? this.filter.price : price;

                this.price.ranges  = price;
                this.price.marks   = price;

                this.price.active  = true;
            },

            filter_price(){
                this.applyFilter();
            }
        }
    }
</script>

<style>
    .vue-slider-mark:first-child .vue-slider-mark-label{
        left: 29px !important;
    }
    .vue-slider-mark:last-child .vue-slider-mark-label{
        right: -45px !important;
        left: initial !important;
    }
</style>

