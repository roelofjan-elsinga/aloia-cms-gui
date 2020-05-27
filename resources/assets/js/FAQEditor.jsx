import * as React from "react";
import ReactDOM from "react-dom";

const e = React.createElement;

export class FAQEditor extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            faqs: props.faq,
            manage: false
        };
    }

    updateState(index, key, value) {
        this.state.faqs[index][key] = value;

        this.setState({
            faqs: this.state.faqs
        }, this.persistState)
    }

    toggleManage() {
        this.setState({manage: !this.state.manage});
    }

    appendFAQ() {
        this.state.faqs.push({
            question: '',
            answer: ''
        });

        this.setState({faqs: this.state.faqs})
    }

    removeFAQ(index) {
        this.setState({
            faqs: this.state.faqs
                .filter((faq, faqIndex) => faqIndex !== index)
        }, this.persistState)
    }

    persistState() {
        if(!this.props.onChange) {
            return;
        }

        this.props.onChange(this.state.faqs);
    }

    render() {

        return (
            <div>
                <h3 className={`mb-2 mt-4`}>FAQ items</h3>

                <button type="button"
                        onClick={() => this.toggleManage()}
                        className={`bg-green-200 block w-full rounded p-4 mb-2 hover:underline`}
                >Manage FAQs</button>

                <div className={this.state.manage ? 'block' : 'hidden'}>
                    {
                        this.state.faqs.map((faq, index) => {

                            return (
                                <div key={index} className={`mb-4 bg-gray-100 px-4 pb-4 pt-1`}>
                                    <label className={`label`}>Question</label>
                                    <input type="text"
                                           className={`border w-full mb-2 rounded px-4 py-2`}
                                           onChange={(e) => this.updateState(index, 'question', e.target.value)}
                                           value={faq.question} />

                                    <label className={`label`}>Answer</label>
                                    <textarea
                                        rows="3"
                                        className={`border w-full mb-2 rounded px-4 py-2`}
                                        onChange={(e) => this.updateState(index, 'answer', e.target.value)}
                                        value={faq.answer}
                                    ></textarea>

                                    <div className={`flex justify-end`}>
                                        <button
                                            className={`bg-red-200 rounded px-4 py-2`}
                                            type={`button`}
                                            onClick={() => this.removeFAQ(index)}>Remove</button>
                                    </div>
                                </div>
                            )

                        })
                    }

                    <button type={`button`} onClick={() => this.appendFAQ()} className={`bg-gray-100 rounded p-4`}>Add a new question</button>
                </div>

            </div>
        );

    }

}

if (document.getElementById('faqEditor') !== null) {
    const element = document.getElementById('faqEditor');

    const faq = element.dataset.faq ? JSON.parse(element.dataset.faq) : [];

    if (!element.dataset.hasOwnProperty('formField')) {
        console.error("You need to do define a form field using data-form-field");
    }

    const formField = document.getElementById(element.dataset.formField);

    const onChange = (values) => {
        formField.value = JSON.stringify(values);
    }

    ReactDOM.render(
        e(FAQEditor, { faq, onChange }),
        element
    );
}