<template>
  <div class="item-form">
    <div
      class="modal fade"
      id="itemFormModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <form @submit.prevent="save" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title text-secondary" id="exampleModalLabel">
                {{ $t("FORM") + " " + $t("ITEM") }}
              </h5>
              <button
                type="button"
                class="close"
                aria-label="Close"
                data-dismiss="modal"
              >
                <i class="fa fa-close"></i>
              </button>
            </div>
            <div class="modal-body">
              <div class="d-flex justify-content-end form-actions">
                <button type="submit" class="btn btn-primary">
                  {{ $t("SUBMIT") }}
                </button>
                <button
                  type="button"
                  class="btn btn-warning mx-1"
                  data-dismiss="modal"
                >
                  {{ $t("CLOSE") }}
                </button>
              </div>
              <div class="tab">
                <div class="d-flex justify-content-start">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item border">
                      <a
                        class="nav-link active"
                        data-toggle="tab"
                        href="#home2"
                        role="tab"
                        aria-selected="true"
                        >{{ $t("DATA_ENTRY") }}</a
                      >
                    </li>
                    <li class="nav-item border">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#profile2"
                        role="tab"
                        aria-selected="false"
                        >{{ $t("IMAGE_UPLOAD") }}</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div
                    class="tab-pane fade show active"
                    id="home2"
                    role="tabpanel"
                  >
                    <div class="py-3">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="exampleInputEmail1">{{
                              $t("NAME_AR")
                            }}</label>
                            <input
                              type="text"
                              class="form-control"
                              v-model="v$.name_ar.$model"
                              :class="{
                                'is-invalid': v$.name_ar.$error || titleArExist,
                              }"
                            />
                            <div class="invalid-feedback">
                              <div
                                v-for="error in v$.name_ar.$errors"
                                :key="error"
                              >
                                {{ $t("NAME_AR") + " " + $t(error.$validator) }}
                              </div>
                              <div v-if="!v$.name_ar.$invalid && titleArExist">
                                {{ $t("NAME_AR") + " " + $t("EXIST") }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>{{ $t("NAME_EN") }}</label>
                            <input
                              type="text"
                              class="form-control"
                              v-model="v$.name_en.$model"
                              :class="{
                                'is-invalid': v$.name_en.$error || titleEnExist,
                              }"
                            />
                            <div class="invalid-feedback">
                              <div
                                v-for="error in v$.name_en.$errors"
                                :key="error"
                              >
                                {{ $t("NAME_EN") + " " + $t(error.$validator) }}
                              </div>
                              <div v-if="!v$.name_en.$invalid && titleEnExist">
                                {{ $t("NAME_EN") + " " + $t("EXIST") }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr class="mt-3 text-primary" />

                      <!--list-->
                      <div
                        class="list"
                        v-for="(item, index) in list"
                        :key="index"
                      >
                        <div class="item row">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label>{{ $t("NAME_AR") }}</label>
                              <input
                                @input="item.name_ar_dirty = true"
                                type="text"
                                class="form-control"
                                v-model="item.name_ar"
                                :class="{
                                  'is-invalid':
                                    item.name_ar_dirty &&
                                    v$.list.$each.$response.$errors[index]
                                      .name_ar.length,
                                }"
                              />
                              <div class="invalid-feedback">
                                <div
                                  v-for="error in v$.list.$each.$response
                                    .$errors[index].name_ar"
                                  :key="error"
                                >
                                  {{
                                    $t("NAME_AR") + " " + $t(error.$validator)
                                  }}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label>{{ $t("NAME_EN") }}</label>
                              <input
                                @input="item.name_en_dirty = true"
                                type="text"
                                class="form-control"
                                v-model="item.name_en"
                                :class="{
                                  'is-invalid':
                                    item.name_en_dirty &&
                                    v$.list.$each.$response.$errors[index]
                                      .name_en.length,
                                }"
                              />
                              <div class="invalid-feedback">
                                <div
                                  v-for="error in v$.list.$each.$response
                                    .$errors[index].name_en"
                                  :key="error"
                                >
                                  {{
                                    $t("NAME_EN") + " " + $t(error.$validator)
                                  }}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 increments">
                            <button
                              class="btn text-danger"
                              @click="removeItem(index)"
                              type="button"
                            >
                              <i class="fa fa-trash"></i>
                            </button>
                            <button
                              v-if="index + 1 == list.length"
                              class="btn text-success"
                              @click="addItem"
                              type="button"
                            >
                              <i class="fa fa-plus"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile2" role="tabpanel">
                    <div class="py-3">
                      <div class="d-flex">
                        <div class="col-lg-12 p-0">
                          <div class="image">
                            <img
                              v-if="previewImage"
                              class="border-bottom"
                              :src="previewImage"
                            />
                            <img
                              v-else
                              class="border-bottom"
                              src="/assets/images/empty.jpg"
                            />
                            <div class="image-upload">
                              <label
                                v-if="!uploadedImage"
                                class="icon"
                                for="image"
                              >
                                <i class="fa fa-camera"></i>
                              </label>
                              <label
                                @click="deleteImage"
                                v-if="uploadedImage"
                                class="icon text-secondary"
                              >
                                <i class="fa fa-close" aria-hidden="true"></i>
                              </label>
                              <input
                                @change="uploadImage"
                                accept="image/apng, image/avif, image/gif, image/jpeg, image/png, image/svg+xml, image/webp"
                                type="file"
                                id="image"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import itemClient from "../../../http-clients/admin/item-client";
import { computed, inject, reactive, toRefs, watch } from "vue-demi";
import { useI18n } from "vue-i18n";
export default {
  setup(props, context) {
    const { t, locale } = useI18n({ useScope: "global" });
    const item_store = inject("item_store");
    const toast = inject("toast");
    const swal = inject("swal");
    const data = reactive({
      uploadedImage: null,
      previewImage: "",
      titleArExist: false,
      titleEnExist: false,
    });
    const form = reactive({
      name_ar: "",
      name_en: "",
      list: [getElement()],
    });
    const rules = {
      name_ar: { required },
      name_en: { required },
      list: {
        $each: helpers.forEach({
          name_ar: { required },
          name_en: { required },
        }),
      },
    };
    const v$ = useVuelidate(rules, form);
    //Methods
    function uploadImage(e) {
      const image = e.target.files[0];
      data.uploadedImage = image;
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        data.previewImage = e.target.result;
      };
    }
    function deleteImage() {
      data.uploadedImage = null;
      data.previewImage = props.selectedItem ? props.selectedItem.image : "";
    }

    function addItem() {
      form.list.push(getElement());
    }

    function removeItem(index) {
      if (form.list.length > 1) {
        form.list.splice(index, 1);
      }
    }
    function save() {
      if (v$.value.$invalid) {
        v$.value.$touch();
        touchlist();
        return;
      }
      if (!props.selectedItem) {
        if (!data.uploadedImage) {
          swal({
            confirmButtonText: t("OK"),
            icon: "error",
            title: t("ERROR"),
            text: t("IMAGE") + " " + t("required"),
          });
          return;
        }
        store();
      } else {
        update();
      }
    }
    //Commons
    function store() {
      data.titleArExist = false;
      data.titleEnExist = false;
      itemClient
        .store(getForm())
        .then((response) => {
          swal({
            confirmButtonText: t("OK"),
            icon: "success",
            title: t("SUCCESS"),
            text: t("CREATED_SUCCESSFULLY"),
          });
          context.emit("created", response.data);
          $("#itemFormModal").modal("hide");
        })
        .catch((error) => {
          data.titleArExist = error.response.data.errors.name_ar ? true : false;
          data.titleEnExist = error.response.data.errors.name_en ? true : false;
        });
    }
    function update() {
      data.titleArExist = false;
      data.titleEnExist = false;
      itemClient
        .update(getForm())
        .then((response) => {
          swal({
            confirmButtonText: t("OK"),
            icon: "success",
            title: t("SUCCESS"),
            text: t("UPDATED_SUCCESSFULLY"),
          });
          context.emit("updated", response.data);
          $("#itemFormModal").modal("hide");
        })
        .catch((error) => {
          data.titleArExist = error.response.data.errors.name_ar ? true : false;
          data.titleEnExist = error.response.data.errors.name_en ? true : false;
        });
    }
    function touchlist() {
      form.list.forEach((item) => {
        item.name_ar_dirty = true;
        item.name_en_dirty = true;
      });
    }
    function getElement() {
      return { name_ar: "", name_en: "" };
    }
    function getForm() {
      let formData = new FormData();
      if (props.selectedItem) {
        formData.append("id", props.selectedItem.id);
      }
      formData.append("name_ar", form.name_ar);
      formData.append("name_en", form.name_en);
      setlistToFormData(formData);
      if (data.uploadedImage) {
        formData.append("image", data.uploadedImage);
      }
      return formData;
    }
    function setlistToFormData(formData) {
      form.list.forEach((item, index) => {
        formData.append(`list[${index}][name_ar]`, item.name_ar);
        formData.append(`list[${index}][name_en]`, item.name_en);
      });
    }
    function setForm() {
      v$.value.$reset();
      form.list = props.selectedItem
        ? _.clone(props.selectedItem.list)
        : [getElement()];
      form.name_ar = props.selectedItem ? props.selectedItem.name_ar : "";
      form.name_en = props.selectedItem ? props.selectedItem.name_en : "";
      data.previewImage = props.selectedItem ? props.selectedItem.image : "";
      data.uploadedImage = null;
      data.titleArExist = false;
      data.titleEnExist = false;
    }
    //Watchers
    watch(
      () => {
        item_store.onFormShow;
      },
      (value) => {
        setForm();
      },
      { deep: true }
    );
    return {
      ...toRefs(data),
      ...toRefs(form),
      v$,
      uploadImage,
      deleteImage,
      addItem,
      removeItem,
      save,
    };
  },
  props: ["selectedItem"],
};
</script>

<style scoped lang="scss">
.item-form {
  .modal-body {
    padding: 0 30px 20px 30px;
  }
  .increments {
    margin-top: 17px;
    display: flex;
    button {
      font-size: 22px;
    }
  }
  .nav-pills {
    border-bottom: none !important;
    margin: 7px 10px 10px 17px;
  }
  .nav-link {
    &.active {
      background: whitesmoke;
    }
    border-color: none !important;
    border: none !important;
  }
  .form-control {
    padding: 10px;
  }
  .form-group {
    margin-bottom: 10px;
    label {
      margin-bottom: 5px;
    }
  }
  .icons {
    i {
      font-size: 20px;
    }
    i:hover {
      cursor: pointer;
    }
  }
  .image {
    margin-top: 10px;
    position: relative;
    .image-upload {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 30px;
      width: 30px;
      position: absolute;
      bottom: 0;
      right: 0px;
      background: #fff;
      i {
        margin-top: 7px;
        color: #888888;
      }
      .icon {
        &:hover {
          cursor: pointer !important;
        }
        i {
          font-size: 14px;
          position: relative;
        }
      }
      text-align: center;
      input[type="file"] {
        display: none;
      }
    }
  }
  .form-actions {
    margin: 25px 0;
    button {
      width: 70px;
      justify-content: center;
      height: 35px;
      align-items: center;
      display: flex;
      font-size: 15px;
    }
  }
}
</style>