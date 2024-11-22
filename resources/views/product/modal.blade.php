<input type="hidden" id="id">

<div class="modal fade" id="addProductButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-car">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2 pb-1 title">Tambah Product Baru</h3>
        </div>
        <form id="addNewCarForm" class="row g-4" onsubmit="return false">
          
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input id="name" name="name" class="form-control" type="text" placeholder="Nama Produk" />
              <div class="invalid-feedback"></div>
              <label for="name">Nama Produk</label>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input id="price" name="price" class="form-control" type="text" placeholder="Harga" />
              <div class="invalid-feedback"></div>
              <label for="price">Harga</label>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <textarea class="form-control h-px-100" id="description"
                placeholder="Deskripsi"></textarea>
              <label for="description">Deskripsi</label>
            </div>
          </div>
          
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input id="poster" name="poster" class="form-control credit-card-mask" type="file" />
              <div class="invalid-feedback"></div>
            </div>
          </div>

          <div class="col-12 text-center">
            <button type="submit" id="submit-button" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
