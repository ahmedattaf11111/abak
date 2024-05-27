<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="deleteConfirmationModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-secondary" id="exampleModalLabel">
            {{ $t("DELETE_CONFIRMATION_HEADER") }}
          </h5>
          <button
            @click="$emit('closed')"
            type="button"
            class="btn-close"
            data-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="rounded-circle border question-icon">
            <i class="fa fa-question"></i>
          </div>
          {{ $t("DELETE_CONFIRMATION_MESSAGE") }}
        </div>
        <div class="modal-footer">
          <button
            data-dismiss="modal"
            @click="$emit('confirm')"
            type="button"
            class="btn btn-primary"
          >
            {{ $t("YES") }}
          </button>
          <button
            @click="$emit('closed')"
            type="button"
            data-dismiss="modal"
            class="btn btn-secondary"
          >
            {{ $t("NO") }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  emits: ["confirm"],
};
</script>

<style scoped lang="scss">
#deleteConfirmationModal {
  button {
    color: white;
  }
  .question-icon {
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
  }
  .modal-body,
  .modal-footer {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .modal-footer {
    button {
      width: 60px;
    }
  }
  .modal-body {
    flex-direction: column;
  }
}
</style>