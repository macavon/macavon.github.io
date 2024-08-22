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

class GlossarySynonym < ActiveRecord::Base
  set_primary_key "term1"
end

all_terms = IO.readlines("all").map{|t| t.chomp }
existing_terms = Array.new

DMTGlossary.find(:all).each do |t|
  existing_terms.push(MasterGlossary.find(t.id).term)
end

def prt(a)
  print(a.sort{|x,y| x.casecmp(y)}.join("\n\n"))
end

new_terms = (all_terms - existing_terms).uniq
truly_new_terms = Array.new(new_terms)

n = 0

truly_new_terms.each do |nt|
   s = GlossarySynonym.find_by_term1(nt)
   unless s.nil?
     truly_new_terms.delete(nt)
    #  canonical = s.term2
    #  canonical_id = MasterGlossary.find_by_term(canonical).id
    #  unless DMTGlossary.find_by_id(canonical_id)
    #    new_entry = DMTGlossary.new
    #    new_entry.id = canonical_id
    #    new_entry.save
    #    n += 1
    # end
  end
end

prt(truly_new_terms)
