         <div class="w-100" style="display: flex; justify-content: start;">
    <div class="table-responsive" style="max-width: 500px;">
          <table class="table table-bordered nowrap smallfnt cursor w-100 trip_distance_table" style="text-align: left;">
                        <tbody>
                            <tr>
                                <th style="width:75%!important;">ஆரம்ப Km</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="starting_km" class="form-control shadow-none" value="<?php if(!empty($starting_km)) { echo $starting_km; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">முடிவு Km</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="ending_km" class="form-control shadow-none" value="<?php if(!empty($ending_km)) { echo $ending_km; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            
                            <tr>
                                <th style="width:75%!important;">ஓடிய Km</th>
                                <th style="width:25%!important;">
                                    <span class="travelled_km"><?php if(!empty($travelled_km)) { echo $travelled_km; } ?></span>
                                    <input type="hidden" name="travelled_km" value="<?php if(!empty($travelled_km)) { echo $travelled_km; } ?>">
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">டீசல் (லிட்டர்)</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="diesel" class="form-control shadow-none" value="<?php if(!empty($diesel)) { echo $diesel; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">மைல்லேஜ்</th>
                                <th style="width:25%!important;">
                                    <span class="mileage_span <?php if(empty($show_tripsheet_profit_loss_id)) { ?>d-none<?php } ?>"><span class="mileage"><?php if(!empty($mileage)) { echo $mileage; } ?></span>பாயிண்ட்</span>
                                    <input type="hidden" name="mileage" value="">
                                </th>
                            </tr>
                            <tr>
                                <th style="width:75%!important;">டீசல்/லிட்டர்(in Rs.)</th>
                                <th style="width:25%!important;">
                                    <div class="form-group mb-0">
                                        <div class="form-label-group in-border">
                                            <input type="text" name="diesel_cost_per_litre" class="form-control shadow-none" value="<?php if(!empty($diesel_cost_per_litre)) { echo $diesel_cost_per_litre; } ?>" style="min-width:100px!important;" onkeyup="Javascript:ProfitLossTotal();">
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                </div>
