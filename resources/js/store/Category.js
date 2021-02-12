import axios from "axios"


const state={
  //Categorys array
  Categories:[],

  //fields for a category 
  Categoryfields:["name",'parent_category']
};

const getters={
  //getters for our state
  getCategories:state=>state.Categories,
};

const actions={
  //fetch Categories from api
  async fetchCategories(context){
      const response=await axios.get("/api/category");
      console.log(response.data);

      context.commit("setCategories",response.data);
       
  },
  //add new Category 
  async addCategory(context,data){
    let formData = new FormData();

    context.state.Categoryfields.forEach(element => {
      formData.append(element, data[element]);
  })
  console.log(formData);
      const response= await axios.post("/api/category",formData);
      // use form data (because we have an image upload)
   
        context.commit("newCategory",response.data);
        console.log(response.data);
  }



};

 

const mutations={
  setCategories:(state,Categories)=>(state.Categories=Categories),
  newCategory:(state,Category)=>state.Categorys.unshift(Category),
};

export default {
    state,getters,actions,mutations
}
