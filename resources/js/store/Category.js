import axios from "axios"


const state = {
    //Categorys array
    Categories: [],

    //fields for a category 
    Categoryfields: ["name", 'parent_category'],
    // object of key value of each category (ex : {1:"sport",2:"education"})
    CategoriesIdsNames: {}
};

const getters = {
    //getters for our state
    getCategories: state => state.Categories,
    getCategoriesNamesIds: state => state.CategoriesIdsNames

};

const actions = {
    //fetch Categories from api
    async fetchCategories(context) {
        const response = await axios.get("/api/category");
        context.commit("setCategories", response.data);

        context.getters.getCategories.forEach(category => {
            context.commit("AddNewCategoryNameId", category)
        })
        console.log(context.state.CategoriesIdsNames);

    },
    //add new Category 
    async addCategory(context, data) {
        let formData = new FormData();

        context.state.Categoryfields.forEach(element => {
            formData.append(element, data[element]);
        })
        console.log(formData);
        const response = await axios.post("/api/category", formData);
        // use form data (because we have an image upload)

        context.commit("newCategory", response.data);
        context.commit("AddNewCategoryNameId", response.data)

    }



};



const mutations = {
    setCategories: (state, Categories) => (state.Categories = Categories),
    newCategory: (state, Category) => state.Categorys.unshift(Category),
    AddNewCategoryNameId: (state, category) => (state.CategoriesIdsNames = { ...state.CategoriesIdsNames, [category.id]: category.name }),
};

export default {
    state, getters, actions, mutations
}
