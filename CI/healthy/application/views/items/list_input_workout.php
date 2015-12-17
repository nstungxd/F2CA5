<table class='register' style="background: #F7F7F7;">
                    <tbody>
                    
                        <tr>
                            <td>
                                <select id="input1" name="input1" class="" required="required">
                                <option value="" selected>Select input 1</option>
                                <?php foreach ($results as $exercise): ?>
                                <option value="<?php echo $exercise->Seq ?>"><?php echo $exercise->Name ?></option>
                                <?php endforeach; ?>
                            </select>
                            </td>
                            <td><input class="medium" id="value1" name="value1" required="required" placeholder="Value 1"></td>
                        </tr>
                     <tr>
                            <td>
                                <select id="input2" name="input2" class="" required="required">
                                <option value="" selected>Select input 2</option>
                                <?php foreach ($results as $exercise): ?>
                                <option value="<?php echo $exercise->Seq ?>"><?php echo $exercise->Name ?></option>
                                <?php endforeach; ?>
                            </select>
                            </td>
                            <td><input class="medium" id="value2" name="value2" required="required" placeholder="Value 2 "></td>
                        </tr>
                     <tr>
                            <td>
                                <select id="input3" name="input3" class="" required="required">
                                <option value="" selected>Select input 3</option>
                                <?php foreach ($results as $exercise): ?>
                                <option value="<?php echo $exercise->Seq ?>"><?php echo $exercise->Name ?></option>
                                <?php endforeach; ?>
                            </select>
                            </td>
                            <td><input class="medium" id="value3" name="value3" required="required" placeholder="Value 3"></td>
                        </tr>
                    </tbody>
                </table>