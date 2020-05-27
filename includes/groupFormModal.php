<!-- Modal -->
<div class="modal fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop1Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="staticBackdrop1Label">Create Group</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="backend/addGroup.php" method="POST">
          <div class="form-group">
            <label for="gname">Group Name</label>
            <input type="text" id="gname" name="gname" autocomplete="off" class="form-control form-control-lg" placeholder="Group Name" required>
          </div>
          <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="friendsRadio" value="G" required>
              <label class="form-check-label" for="friendsRadio">Friends</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="familyRadio" value="F" required>
              <label class="form-check-label" for="familyRadio">Family</label>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" name="gsubmit" class="btn btn-outline-warning btn-lg">Create Group</button>
            <hr>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" style="align-self: center;" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Ends -->