<!-- Modal -->
<div wire:ignore.self class="modal fade" id="surveymodal" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Survey for {{ $subjectname }}</h3>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form>
                    <table class="table">
                        <tr>
                            <th colspan="6" style="font-size: 20px">
                                1. Instructor/Lecturer
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="text-align: center">Totally Disagree</td>
                            <td style="text-align: center">Disagree</td>
                            <td style="text-align: center">Neutral</td>
                            <td style="text-align: center">Agree</td>
                            <td style="text-align: center">Fully Agree</td>
                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Do you think that your lecturer is well qualified @error('a1')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="a1" id="a1" wire:model='a1' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="a1" id="a1" wire:model='a1' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="a1" id="a1" wire:model='a1' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="a1" id="a1" wire:model='a1' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="a1" id="a1" wire:model='a1' value="5" required></td>

                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Are you satisfied with your lecturer's way of teaching @error('a2')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="a2" id="a2" wire:model='a2' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="a2" id="a2" wire:model='a2' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="a2" id="a2" wire:model='a2' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="a2" id="a2" wire:model='a2' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="a2" id="a2" wire:model='a2' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Do you think your lecturer having enough related working experience on subject matter @error('a3')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="a3" id="a3" wire:model='a3' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="a3" id="a3" wire:model='a3' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="a3" id="a3" wire:model='a3' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="a3" id="a3" wire:model='a3' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="a3" id="a3" wire:model='a3' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Do you think that your lecturer was an expert in your subject matter @error('a4')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="a4" id="a4" wire:model='a4' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="a4" id="a4" wire:model='a4' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="a4" id="a4" wire:model='a4' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="a4" id="a4" wire:model='a4' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="a4" id="a4" wire:model='a4' value="5" required></td>

                        </tr>

                        <tr>
                            <th colspan="6" style="font-size: 20px">
                                2. Teaching Method
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="text-align: center">Totally Disagree</td>
                            <td style="text-align: center">Disagree</td>
                            <td style="text-align: center">Neutral</td>
                            <td style="text-align: center">Agree</td>
                            <td style="text-align: center">Fully Agree</td>
                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Are you satisfied with the way your lecturer conduct your classes @error('b1')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="b1" id="b1" wire:model='b1' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="b1" id="b1" wire:model='b1' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="b1" id="b1" wire:model='b1' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="b1" id="b1" wire:model='b1' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="b1" id="b1" wire:model='b1' value="5" required></td>

                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Do you think online classes for the first two months prior face to face classes helps you a lot ? @error('b2')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="b2" id="b2" wire:model='b2' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="b2" id="b2" wire:model='b2' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="b2" id="b2" wire:model='b2' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="b2" id="b2" wire:model='b2' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="b2" id="b2" wire:model='b2' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Do you think teaching material provided was enough for your study preparation towards examination @error('b3')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="b3" id="b3" wire:model='b3' value="1"  required></td>
                            <td style="text-align: center"><input type="radio" name="b3" id="b3" wire:model='b3' value="2"  required></td>
                            <td style="text-align: center"><input type="radio" name="b3" id="b3" wire:model='b3' value="3"  required></td>
                            <td style="text-align: center"><input type="radio" name="b3" id="b3" wire:model='b3' value="4"  required></td>
                            <td style="text-align: center"><input type="radio" name="b3" id="b3" wire:model='b3' value="5"  required></td>

                        </tr>
                         <tr>
                            <th colspan="6" style="font-size: 20px">
                                3. Teaching Tools
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="text-align: center">Totally Disagree</td>
                            <td style="text-align: center">Disagree</td>
                            <td style="text-align: center">Neutral</td>
                            <td style="text-align: center">Agree</td>
                            <td style="text-align: center">Fully Agree</td>
                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">How's the study online platform @error('c1')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="c1" id="c1" wire:model='c1' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="c1" id="c1" wire:model='c1' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="c1" id="c1" wire:model='c1' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="c1" id="c1" wire:model='c1' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="c1" id="c1" wire:model='c1' value="5" required></td>

                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Are you satisfied with classroom facility @error('c2')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="c2" id="c2" wire:model='c2' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="c2" id="c2" wire:model='c2' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="c2" id="c2" wire:model='c2' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="c2" id="c2" wire:model='c2' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="c2" id="c2" wire:model='c2' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Are you happy with the digital content of your library @error('c3')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="c3" id="c3" wire:model='c3' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="c3" id="c3" wire:model='c3' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="c3" id="c3" wire:model='c3' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="c3" id="c3" wire:model='c3' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="c3" id="c3" wire:model='c3' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Please rate your physical library facilities @error('c4')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="c4" id="c4" wire:model='c4' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="c4" id="c4" wire:model='c4' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="c4" id="c4" wire:model='c4' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="c4" id="c4" wire:model='c4' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="c4" id="c4" wire:model='c4' value="5"  required></td>

                        </tr>

                        <tr>
                            <th colspan="6" style="font-size: 20px">
                                4. Campus facilities and Support
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="text-align: center">Totally Disagree</td>
                            <td style="text-align: center">Disagree</td>
                            <td style="text-align: center">Neutral</td>
                            <td style="text-align: center">Agree</td>
                            <td style="text-align: center">Fully Agree</td>
                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Please rate campus facilities (eg: Cafeteria/Student's Lounge/Sports etc) @error('d1')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="d1" id="d1" wire:model='d1' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="d1" id="d1" wire:model='d1' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="d1" id="d1" wire:model='d1' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="d1" id="d1" wire:model='d1' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="d1" id="d1" wire:model='d1' value="5" required></td>

                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Please rate international students' support services @error('d2')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="d2" id="d2" wire:model='d2' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="d2" id="d2" wire:model='d2' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="d2" id="d2" wire:model='d2' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="d2" id="d2" wire:model='d2' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="d2" id="d2" wire:model='d2' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Please rate accommodation provided @error('d3')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="d3" id="d3" wire:model='d3' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="d3" id="d3" wire:model='d3' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="d3" id="d3" wire:model='d3' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="d3" id="d3" wire:model='d3' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="d3" id="d3" wire:model='d3' value="5" required></td>

                        </tr>

                        <tr>
                            <th colspan="6" style="font-size: 20px">
                                5. Other
                            </th>
                        </tr>
                        <tr>
                            <td></td>
                            <td  style="text-align: center">Totally Disagree</td>
                            <td style="text-align: center">Disagree</td>
                            <td style="text-align: center">Neutral</td>
                            <td style="text-align: center">Agree</td>
                            <td style="text-align: center">Fully Agree</td>
                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Lecturers at the international institution are much better than local institution @error('e1')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="e1" id="e1" wire:model='e1' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="e1" id="e1" wire:model='e1' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="e1" id="e1" wire:model='e1' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="e1" id="e1" wire:model='e1' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="e1" id="e1" wire:model='e1' value="5" required></td>

                        </tr>
                        <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">Are you going to recommend O'brien to your friends @error('e2')
                                <br><span class="error text-danger">{{  __('Please choose an answer.') }}</span> @enderror</td>
                            <td style="text-align: center"><input type="radio" name="e2" id="e2" wire:model='e2' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="e2" id="e2" wire:model='e2' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="e2" id="e2" wire:model='e2' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="e2" id="e2" wire:model='e2' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="e2" id="e2" wire:model='e2' value="5" required></td>

                        </tr>  <tr>
                            <td class="question" style="padding-left: 10%;width: 50%">International study experience is important
                                @error('e3')
                                <br><span class="error text-danger">{{ __('Please choose an answer.') }}</span> @enderror </td>
                            <td style="text-align: center"><input type="radio" name="e3" id="e3" wire:model='e3' value="1" required></td>
                            <td style="text-align: center"><input type="radio" name="e3" id="e3" wire:model='e3' value="2" required></td>
                            <td style="text-align: center"><input type="radio" name="e3" id="e3" wire:model='e3' value="3" required></td>
                            <td style="text-align: center"><input type="radio" name="e3" id="e3" wire:model='e3' value="4" required></td>
                            <td style="text-align: center"><input type="radio" name="e3" id="e3" wire:model='e3' value="5" required></td>

                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Cancel</button>
                <button type="button" wire:click.prevent="survey()"
                    class="btn btn-primary close-modal">Submit</button>
            </div>
        </div>
    </div>
</div>
