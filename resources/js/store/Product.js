import axios from "axios"


const state={
  //products array
  Products:[],
  //title
  title:"Product Management",
  //fields for a prduct 
  fields:["name",'description','price','image','category']
};

const getters={
  //getters for our state
  getProducts:state=>state.Products,
  getTitle:state=>state.title,
  getUrl:state=>state.url

};

const actions={
  //fetch products from api
  async fetchProducts(context){
      const response=await axios.get("/api/product");
      console.log(response.data);
      context.commit("setProducts",response.data);
       
  },
  //add new product 
  async addProduct(context,data){
    let formData = new FormData();

    context.state.fields.forEach(element => {
      formData.append(element, data[element]);
  })
  console.log(formData);
      const response= await axios.post("/api/product",formData);
      // use form data (because we have an image upload)
   
        context.commit("newProduct",response.data);
        console.log(response.data);
  }



};

 

const mutations={
  setProducts:(state,Products)=>(state.Products=Products),
  newProduct:(state,Product)=>state.Products.unshift(Product),
};

export default {
    state,getters,actions,mutations
}
