#!/usr/bin/env ruby
#
#  Created by Nigel Chapman on 2007-10-15.
#  Copyright (c) 2007. All rights reserved.

require "rubygems"

require_gem "activerecord"

ActiveRecord::Base.establish_connection(:adapter => "mysql",
                                        :host => "127.0.0.1",
                                        :database => "shared_glossary",
                                        :username => "shared_glossary",
                                        :password => "dunn0ck")
                                        
class MasterGlossary < ActiveRecord::Base
  set_table_name "master_glossary"
  has_one :dmt_glossary
  has_one :dmt_term
end

class DMTGlossary < ActiveRecord::Base
  set_table_name "dmt_glossary"
  belongs_to :master_glossary,
             :foreign_key => "id"
end

class DMT_terms < ActiveRecord::Base
  set_primary_key "term"
  belongs_to :master_glossary,
             :foreign_key => "term"
end

n = 0
new_terms = Hash.new(0)

DMTGlossary.find(:all).each do |g|
  d = g.master_glossary.definition
  d.scan(/<CrossReference>([^<]+)<\/CrossReference>/) do |xref|
    x = MasterGlossary.find_by_term(xref)
    unless x.nil? || DMTGlossary.exists?(x.id)
      
      # change next three lines to just print them first time
      # new_entry = DMTGlossary.new
      # new_entry.id = x.id
      # new_entry.save
      puts "#{x.id}: #{x.term}\n"
      n += 1
    end
  end
end

puts "Found #{n} new terms"
