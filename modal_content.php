<button type="button" data-toggle="modal" data-target="#LRPrintModal" class="d-none lr_print_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="LRPrintModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Print View</h1>
                <button type="button" class="close d-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to print?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success yes" onClick="Javascript:ConfirmLRPrint(this);" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-danger no" onClick="Javascript:CancelLRPrint(this);" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<button type="button" data-toggle="modal" data-target="#deletemodal" class="d-none delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Delete</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success no" onClick="Javascript:cancel_delete_modal(this);" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger yes" onClick="Javascript:confirm_delete_modal(this);" >Delete</button>
            </div>
        </div>
    </div>
</div>

<button type="button" data-toggle="modal" data-target="#PaymentStatusModal" class="d-none paymentstatus_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PaymentStatusModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog ">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Payment Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        
        </div>
    </div>
</div>

<button type="button" data-toggle="modal" data-target="#AcknowledgementModal" class="d-none acknowledgement_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="AcknowledgementModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Invoice Acknowledgement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#AcknowledgementInvoiceModal" class="d-none acknowledgement_invoice_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="AcknowledgementInvoiceModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Invoice Acknowledgement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#clearancemodal" class="d-none clearance_modal_button"></button>
<div class="modal fade" id="clearancemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Parcel Receiving Person Details</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <!-- <div class="modal-footer">
                <button class="btn btn-dark btnwidth submit_button" type="button" onClick="Javascript:SaveModalContent('clearance_form', 'clearance_entry_changes.php', 'clearance_entry.php');">Submit</button>
            </div> -->
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#ReceiptDeleteModal" class="d-none receipt_delete_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ReceiptDeleteModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close d-none" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            Modal body..
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_receipt_delete_modal(this);">Yes</button>
            <button type="button" class="btn btn-danger no" onClick="Javascript:cancel_delete_modal(this);">No</button>
        </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#PreviewUpdateModal" class="d-none preview_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PreviewUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Preview Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>
<button type="button" data-toggle="modal" data-target="#RemarksUpdateModal" class="d-none remarks_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="RemarksUpdateModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Receipt</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success yes" onClick="Javascript:confirm_delete_receipt_modal(this);">Submit</button>
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#ViewDetailsModal"
    class="d-none details_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ViewDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>


<button type="button" data-bs-toggle="modal" data-bs-target="#PendingDetailsModal"
    class="d-none pending_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="PendingDetailsModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                Modal body..
            </div>
        </div>
    </div>
</div>


<button type="button" data-bs-toggle="modal" data-bs-target="#CustomPartyModal" class="d-none custom_party_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="CustomPartyModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Custom Party</h4>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>


<button type="button" data-bs-toggle="modal" data-bs-target="#CustomProductModal" class="d-none custom_product_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="CustomProductModal" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Custom Product</h4>
                <!-- <button type="button" class="btn-close close" data-bs-dismiss="modal"></button> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<button type="button" data-bs-toggle="modal" data-bs-target="#UploadModal" class="d-none upload_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="UploadModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content" style="height:150px !important;">
        
            <!-- Modal Header -->
            <div class="modal-header ">
                <h4 class="modal-title">Product Upload</h4>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="window.open('product.php','_self');" aria-label="Close">
                </button>
                <button type="button" class="close2 d-none" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        
            <!-- Modal body -->
            <div class="modal-body text-center">
                <button type="button" class="btn btn-success" onClick="Javascript:UploadExcel('1');">New</button>
                &nbsp;
                <button type="button" class="btn btn-success" onClick="Javascript:UploadExcel('2');">Overwrite</button>
            </div>                                    
        </div>
    </div>
</div>


<button type="button" class="d-none payment_modal_button" data-bs-toggle="modal" data-bs-target="#PaymentModal"></button>

<div class="modal fade" id="PaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5">Preview</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
          
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>



<button type="button" data-toggle="modal" data-target="#ExpenseModal" class="d-none expense_modal_button"></button>
<!-- The Modal -->
<div class="modal fade" id="ExpenseModal" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>