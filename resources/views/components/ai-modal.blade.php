<div class="modal fade" tabindex="-1" id="{{ $id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">{{ $title }}</h5>
                <div class="nk-block">
                    <div class="row gy-gs">
                        <div class="col-md-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">How it works?</h6>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <p>
                                            This feature leverages advanced AI algorithms to help analyze uploaded documents.
                                            It extracts details using OCR and smart matching, improving the chances of locating
                                            lost or found IDs.
                                        </p>
                                        <p>
                                            To use this feature, simply upload an image of the document. AI will process and
                                            provide structured extracted information.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Get Started</h6>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" for="{{ $id }}_document">
                                                    Upload {{ $title }} Image
                                                </label>
                                                <input type="file" class="form-control"
                                                       id="{{ $id }}_document"
                                                       name="document"
                                                       accept="image/*">
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .row -->
                </div> <!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
