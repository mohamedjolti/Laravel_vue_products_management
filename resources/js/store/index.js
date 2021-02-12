import Vuex from "vuex"
import Vue from "vue"
import Product from "./Product"
import Category from "./Category"
//load vuex

Vue.use(Vuex)

export default new Vuex.Store({
    modules:{        
     Product,
     Category
    }
});