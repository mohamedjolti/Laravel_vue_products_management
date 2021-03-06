<template>
  <v-card>
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Filter By category"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="filterProducts"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:item.image="{ item }">
        <v-img
          id="image_round"
          :src="'/storage/photos/' + item.image"
          max-width="50px"
          max-height="70px"
        ></v-img>
      </template>
      <template v-slot:item.category="{ item }">
        <v-chip blue>
          {{ getCategoriesNamesIds[item.category] }}
        </v-chip>
      </template>
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>Add new Product</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialog" max-width="500px">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="info" dark class="mb-2" v-bind="attrs" v-on="on">
                New Product
              </v-btn>
            </template>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.name"
                        label="Product name"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.description"
                        label="Description"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        v-model="editedItem.price"
                        label="Price"
                        type="number"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-select
                        v-model="editedItem.category"
                        :items="getCategories"
                        item-text="name"
                        item-value="id"
                        label="category"
                      >
                      </v-select>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <input
                        class="image-special"
                        @change="selectFile($event)"
                        placeholder="image"
                        type="file"
                      />
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                  Cancel
                </v-btn>
                <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="initialize"> Reset </v-btn>
      </template>
    </v-data-table>
  </v-card>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
  data: () => ({
    dialog: false,
    dialogDelete: false,
    search: "",
    headers: [
      {
        text: "Name",
        align: "start",
        sortable: true,
        value: "name",
        filterable: false,
      },
      {
        text: "description",
        value: "description",
        sortable: false,
        filterable: false,
      },
      { text: "price", value: "price", sortable: true, filterable: false },
      {
        text: "category",
        value: "category",
        sortable: false,
        filterable: true,
      },
      { text: "image", value: "image", sortable: false, filterable: false },
    ],
    desserts: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      description: "",
      price: 0,
      category: 0,
      image: "",
    },
    defaultItem: {
      name: "",
      description: "",
      price: 0,
      category: 0,
      image: "",
    },
  }),

  computed: {
    ...mapGetters(["getProducts", "getCategories", "getCategoriesNamesIds"]),
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
    filterProducts() {
      var obj = JSON.parse(JSON.stringify(this.getCategoriesNamesIds));
      return this.getProducts.filter((product) => {
        return obj[product["category"]].match(this.search);
      });
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    //call the action to f
    this.fetchCategories();
    this.fetchProducts();
  },

  methods: {
    ...mapActions([
      "fetchProducts",
      "addProduct",
      "fetchCategories",
      "getCategoryNameById",
    ]),

    initialize() {
      this.desserts = [
        {
          name: "ddsd",
          description: 159,
          price: 6.0,
          category: 24,
          image: 4.0,
        },
        {
          name: "ddsd",
          description: 159,
          price: 6.0,
          category: 24,
          image: 4.0,
        },
      ];
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    selectFile(event) {
      this.editedItem["image"] = event.target.files[0];
      console.log(this.editedItem[name]);
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
      console.log(this.getCategories);
    },

    save() {
      console.log(this.editedItem);
      this.addProduct(this.editedItem);

      this.close();
    },
  },
};
</script>

<style>
v-img {
  border-radius: 50%;
}
.image-special {
  position: relative;
  top: 12px;
}
</style>