# First, rename all tables

RENAME TABLE "fi_client_custom" TO "ip_client_custom";
RENAME TABLE "fi_client_notes" TO "ip_client_notes";
RENAME TABLE "fi_clients" TO "ip_clients";
RENAME TABLE "fi_custom_fields" TO "ip_custom_fields";
RENAME TABLE "fi_email_templates" TO "ip_email_templates";
RENAME TABLE "fi_import_details" TO "ip_import_details";
RENAME TABLE "fi_imports" TO "ip_imports";
RENAME TABLE "fi_invoice_amounts" TO "ip_invoice_amounts";
RENAME TABLE "fi_invoice_custom" TO "ip_invoice_custom";
RENAME TABLE "fi_invoice_groups" TO "ip_invoice_groups";
RENAME TABLE "fi_invoice_item_amounts" TO "ip_invoice_item_amounts";
RENAME TABLE "fi_invoice_items" TO "ip_invoice_items";
RENAME TABLE "fi_invoice_tax_rates" TO "ip_invoice_tax_rates";
RENAME TABLE "fi_invoices" TO "ip_invoices";
RENAME TABLE "fi_invoices_recurring" TO "ip_invoices_recurring";
RENAME TABLE "fi_item_lookups" TO "ip_item_lookups";
RENAME TABLE "fi_merchant_responses" TO "ip_merchant_responses";
RENAME TABLE "fi_payment_custom" TO "ip_payment_custom";
RENAME TABLE "fi_payment_methods" TO "ip_payment_methods";
RENAME TABLE "fi_payments" TO "ip_payments";
RENAME TABLE "fi_quote_amounts" TO "ip_quote_amounts";
RENAME TABLE "fi_quote_custom" TO "ip_quote_custom";
RENAME TABLE "fi_quote_item_amounts" TO "ip_quote_item_amounts";
RENAME TABLE "fi_quote_items" TO "ip_quote_items";
RENAME TABLE "fi_quote_tax_rates" TO "ip_quote_tax_rates";
RENAME TABLE "fi_quotes" TO "ip_quotes";
RENAME TABLE "fi_settings" TO "ip_settings";
RENAME TABLE "fi_tax_rates" TO "ip_tax_rates";
RENAME TABLE "fi_user_clients" TO "ip_user_clients";
RENAME TABLE "fi_user_custom" TO "ip_user_custom";
RENAME TABLE "fi_users" TO "ip_users";
RENAME TABLE "fi_versions" TO "ip_versions";

# Rename the custom field entries
UPDATE  fi_custom_fields
    SET custom_field_table = CONCAT('ip', SUBSTRING(custom_field_table, 3, LENGTH(custom_field_table)-3));
    
# Reset the version table
TRUNCATE ip_versions;

# Insert the first IP version
INSERT INTO ip_versions
    VALUES (
        "",
        ".time().",
        "000_1.0.0.sql",
        0
    );