@component("user.layout.template-user", ["user" => $user])
    <div class="row mt-3">
        <div class="col">
            <div class="card mt-4">
                <div class="card-header">
                  <div class="row">
                      <div class="col-md-10">
                          <h5 class="card-title">
                              Les Notifications
                          </h5>
                      </div>
                      <div class="col-md-2 float-right">
                          <button class="btn btn-primary">Dell All</button>
                      </div>
                  </div>
                </div>
                <div class="card-body">
                    <notification-list></notification-list>

                </div>
            </div>
        </div>
    </div>
@endcomponent
